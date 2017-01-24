<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Arcadat Template '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/colegio', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Arcadat Template '/colegio' route");

    // Render index view
    return $this->renderer->render($response, 'frm_col_id.phtml', $args);
});

$app->post('/colegio', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Arcadat Template '/colegio' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
