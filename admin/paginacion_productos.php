<?php
require __DIR__ . '/../drivers/conexion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$genero = isset($_GET['genero']) ? trim($_GET['genero']) : null;
$filtroGenero = '';
$params = [];
$types = '';

if ($genero) {
    $filtroGenero = 'WHERE genero = ?';
    $params[] = $genero;
    $types .= 's';
}

// Funcion para validar que la url sea válida
function resolverSrcImagen($valor) {
    $default = "https://www.venuzstore.com/fotos/default.png";

    if (empty($valor)) {
        return $default;
    }

    // Base64
    if (str_starts_with($valor, 'data:image')) {
        //  eliminar saltos de línea y espacios
        $valor = preg_replace('/\s+/', '', $valor);
        return $valor;
    }

    // URL http o https
    if (filter_var($valor, FILTER_VALIDATE_URL)) {
        return $valor;
    }

    // Cualquier otra cosa NO es válida
    return $default;
}




$productosPorPagina = 5;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $productosPorPagina;

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'producto_id DESC';
$ordenPermitidos = [
    'producto_id DESC', 'producto_id ASC',
    'precio ASC', 'precio DESC',
    'stock ASC', 'stock DESC',
    'nombre ASC', 'nombre DESC'
];
if (!in_array($orden, $ordenPermitidos)) {
    $orden = 'producto_id DESC';
}

$sqlTotal = "SELECT COUNT(*) as total FROM productos $filtroGenero";
$stmtTotal = $conn->prepare($sqlTotal);
if ($genero) $stmtTotal->bind_param($types, ...$params);
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result();
$totalProductos = $resultTotal->fetch_assoc()['total'];
$totalPaginas = ceil($totalProductos / $productosPorPagina);

$sql = "SELECT * FROM productos $filtroGenero ORDER BY $orden LIMIT ?, ?";
$stmt = $conn->prepare($sql);

if ($genero) {
    $params[] = $offset;
    $params[] = $productosPorPagina;
    $types .= 'ii';
    $stmt->bind_param($types, ...$params);
} else {
    $stmt->bind_param("ii", $offset, $productosPorPagina);
}

$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['producto_id']."</td>";

        $producto_id = $row['producto_id'];

        // Consulta secundaria para traer imágenes adicionales
        $sqlImg = "SELECT url_imagen FROM imagenes_adicionales WHERE producto_id = ?";
        $stmtImg = $conn->prepare($sqlImg);
        $stmtImg->bind_param("i", $producto_id);
        $stmtImg->execute();
        $resultImg = $stmtImg->get_result();

        $imagenes_adicionales = [];
        while ($imgRow = $resultImg->fetch_assoc()) {
            $imagenes_adicionales[] = $imgRow['url_imagen'];
        }

        // Formatear HTML
        if (!empty($imagenes_adicionales)) {
        $imagenesHtml = '';
        foreach ($imagenes_adicionales as $imgUrl) {
        $src = resolverSrcImagen($imgUrl);
        $imagenesHtml .= "<img src='$src' class='img-thumbnail me-1' width='40'
            onerror=\"this.onerror=null;this.src='https://www.venuzstore.com/fotos/default.png'\">";
        }
        } else {
            $imagenesHtml = 'Ninguna';
        }

        //Consulta secundaria (bueno 3ra) para traer Talla y Stock
        $sqlTallas = "SELECT talla, stock FROM tallas_productos WHERE producto_id = ?";
        $stmtTallas = $conn->prepare($sqlTallas);
        $stmtTallas->bind_param("i", $producto_id);
        $stmtTallas->execute();
        $resultTallas = $stmtTallas->get_result();

        $tallas_stock = [];
        $tallasSolo = [];
        $stocksSolo = [];

        while ($fila = $resultTallas->fetch_assoc()) {
            $talla = htmlspecialchars($fila['talla']);
            $stock = (int)$fila['stock'];

            $tallas_stock[] = "$talla ($stock)";
            $tallasSolo[] = $talla;
            $stocksSolo[] = $stock;
        }
        // Calcular stock total
        $stockTotal = array_sum($stocksSolo);
        
        // Convertir a JSON para el JS
        $tallasJson = json_encode($tallasSolo);
        $stocksJson = json_encode($stocksSolo);

        // Mostrar en HTML
        $tallasHtml = !empty($tallas_stock) ? implode(', ', $tallas_stock) : "Sin tallas";

        echo "<td>".htmlspecialchars($row['nombre'])."</td>";
        echo "<td>".htmlspecialchars($row['descripcion'])."</td>";
        echo "<td>$".number_format($row['precio'], 2)."</td>";
        echo "<td>".intval($stockTotal)."</td>";

        // Imagen principal
        $imagen = resolverSrcImagen($row['imagen']);
        echo "<td>
                <img src='$imagen'
                    class='img-thumbnail'
                    width='40'
                    onerror=\"this.onerror=null;this.src='https://www.venuzstore.com/fotos/default.png'\">
            </td>";

        // Imagen back
        $imagen_back = resolverSrcImagen($row['imagen_back']);
        echo "<td class='text-center'>
                <img src='$imagen_back'
                    class='img-thumbnail'
                    width='40'
                    onerror=\"this.onerror=null;this.src='https://www.venuzstore.com/fotos/default.png'\">
            </td>";

        echo "<td>".htmlspecialchars($row['genero'])."</td>";
        echo "<td>".htmlspecialchars($row['tipo_producto'])."</td>";
        echo "<td>".htmlspecialchars($row['color'])."</td>";
        echo "<td>".htmlspecialchars($tallasHtml)."</td>";
        echo "<td>$imagenesHtml</td>";
        echo "<td>".htmlspecialchars($row['fecha_ingreso'])."</td>";
        echo "<td>".htmlspecialchars($row['destacado_newin'])."</td>";
        
// ***********************************************************************************
        // Botones y abrir modal editar
// ***********************************************************************************
        echo "<td>
        <button class='btn btn-warning btn-sm btn-abrir-editar'
            data-id='".$row['producto_id']."'
            data-nombre=\"".htmlspecialchars($row['nombre'], ENT_QUOTES)."\"
            data-descripcion=\"".htmlspecialchars($row['descripcion'], ENT_QUOTES)."\"
            data-precio='".$row['precio']."'
            data-imagen=\"".htmlspecialchars($row['imagen'], ENT_QUOTES)."\"
            data-imagen_back=\"".htmlspecialchars($row['imagen_back'], ENT_QUOTES)."\"
            data-genero=\"".htmlspecialchars($row['genero'], ENT_QUOTES)."\"
            data-tipo_producto=\"".htmlspecialchars($row['tipo_producto'], ENT_QUOTES)."\"
            data-color=\"".htmlspecialchars($row['color'], ENT_QUOTES)."\"
            data-fecha=\"".$row['fecha_ingreso']."\"
            data-new_in=\"".$row['destacado_newin']."\"
            data-talla='".json_encode($tallasSolo)."'
            data-stock='".json_encode($stocksSolo)."'
            data-bs-toggle='modal' data-bs-target='#modalEditar'>
            <span>✏️</span>
        </button>

        <button class='btn btn-sm btn-danger eliminarBtn'
            onclick='eliminarProducto(".$row['producto_id'].")'>
            <span>❌</span>
        </button>
    </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='15' class='text-center'>No hay productos disponibles</td></tr>";
}

// Paginación
echo "<tr><td colspan='15' class='text-center'>";
for ($i = 1; $i <= $totalPaginas; $i++) {
    echo "<button class='btn btn-info btn-sm mx-1' onclick='cargarPagina($i)'>$i</button>";
}
echo "</td></tr>";

$conn->close();
?>

