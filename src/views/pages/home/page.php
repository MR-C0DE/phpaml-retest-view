<?php

declare(strict_types=1);

namespace App\Views\Pages\Home;

use AML\View\Page;
use AML\View\View;
use function AML\View\{Heading, MainContent, Text, VStack};

final class HomePage extends Page
{
    public function body(): View
    {
        return MainContent(
            VStack(
                Text('PHPAML VIEW · PRODUCTION')->class('eyebrow'),
                Heading('View renders correctly.', 1),
                Text('A new PHPAML View project installed and rendered by the shared production engine.'),
                Text('GET /api/health')->class('endpoint'),
            )->class('panel'),
        )->class('page');
    }
}
