<?php
$input = $_GET['input'];
if (preg_match('/^[0-9+-\/\*\sEURBSD\(\)]+$/', $input)) {
    $currencies = ['RUB', 'EUR', 'USD'];
    $rates = ['*1', '*90', '*75'];
    $expression = str_replace($currencies, $rates, $input);
    try {
        eval('$output = '.$expression.';');
    } catch (ParseError $exception) {
        header('Content-type: application/json');
        echo json_encode(['error' => 'Неверные входные данные!']);
        header("HTTP/1.0 400 Bad request");
        die();
    }

    header('Content-type: application/json');
    echo json_encode(['result' => $output]);
} else {
    header('Content-type: application/json');
    echo json_encode(['error' => 'Неверные входные данные!']);
    header("HTTP/1.0 400 Bad request");
}
