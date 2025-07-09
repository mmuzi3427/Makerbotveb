<?php  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $phone = $data['phone'];
    $type = $data['type'];
    $message = $data['message'];

    // Murojaatlarni JSON fayliga saqlash  
    $queries = [];
    if (file_exists('queries.json')) {
        $queries = json_decode(file_get_contents('queries.json'), true);
    }

    $queries[] = [
        'name' => $name,
        'phone' => $phone,
        'type' => $type,
        'message' => $message,
        'date' => date('Y-m-d H:i:s')
    ];

    file_put_contents('queries.json', json_encode($queries, JSON_PRETTY_PRINT));

    echo json_encode(['message' => 'Murojaatingiz muvaffaqiyatli yuborildi!']);
}
?>