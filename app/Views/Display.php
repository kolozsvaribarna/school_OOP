<?php
namespace App\Views;

class Display
{
    static function message(string $message)
    {
        echo <<<HTML
    <div style="position: relative; padding: 10px; margin: 10px 0;">
        <button onclick='this.parentElement.style.display = "None";'>×</button>
        <p>$message</p>
    </div>
HTML;
    }
}