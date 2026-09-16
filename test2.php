<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/', 'GET');
$response = $kernel->handle($request);
$content = $response->getContent();
// Check if CSS/JS are loaded
if (strpos($content, 'app-') !== false) {
    echo "CSS/JS LOADED\n";
} else {
    echo "CSS/JS NOT LOADED\n";
}
// Check for vite references
if (strpos($content, '@vite') !== false || strpos($content, 'resources/css/app.css') !== false || strpos($content, 'public/build/assets') !== false) {
    echo "VITE REFERENCES FOUND\n";
} else {
    echo "VITE REFERENCES NOT FOUND\n";
}
// Extract CSS/JS links
preg_match_all('/href="([^"]*\.css[^"]*)"/', $content, $css_matches);
preg_match_all('/src="([^"]*\.js[^"]*)"/', $content, $js_matches);
echo "CSS links: " . implode(', ', $css_matches[1] ?? []) . "\n";
echo "JS links: " . implode(', ', $js_matches[1] ?? []) . "\n";
// Check for errors in content
if (strpos($content, 'error') !== false || strpos($content, 'Error') !== false || strpos($content, 'undefined') !== false) {
    echo "Potential issues found in content\n";
} else {
    echo "No obvious errors in content\n";
}
// Check if the head section has CSS
$head = substr($content, strpos($content, '<head>'), strpos($content, '</head>') - strpos($content, '<head>'));
echo "\nHead section length: " . strlen($head) . "\n";
if (strpos($head, '<link') !== false || strpos($head, '<style') !== false) {
    echo "CSS found in head\n";
} else {
    echo "No CSS in head\n";
}
if (strpos($head, '<script') !== false) {
    echo "JS found in head\n";
} else {
    echo "No JS in head\n";
}