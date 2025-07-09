<?php  
$queries = [];
if (file_exists('queries.json')) {
    $queries = json_decode(file_get_contents('queries.json'), true);
}

// O'chirish funksiyasi  
if (isset($_POST['delete'])) {
    $idToDelete = (int)$_POST['delete'];
    unset($queries[$idToDelete]);
    file_put_contents('queries.json', json_encode(array_values($queries), JSON_PRETTY_PRINT));
    header("Location: admin.php"); // O'zgarishlar saqlangandan so'ng sahifani yangilang  
    exit();
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Murojaatlar</h2>
        <div class="query-list">
            <?php foreach ($queries as $index => $query): ?>
                <div class="query-item">
                    <strong><?php echo htmlspecialchars($query['name']); ?></strong> (<?php echo htmlspecialchars($query['phone']); ?>) - 
                    <?php echo htmlspecialchars($query['type']); ?>: <?php echo htmlspecialchars($query['message']); ?> - 
                    <small><?php echo htmlspecialchars($query['date']); ?></small>
                    <form action="admin.php" method="POST" style="display:inline;">
                        <button type="submit" name="delete" value="<?php echo $index; ?>" onclick="return confirm('Murojaatni o\'chirishni xohlaysizmi?');">Oʻchirish</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>