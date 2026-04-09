const fs = require('fs');
const path = require('path');

const dirs = [
    'resources/views/admin',
    'resources/views/platform',
    'resources/views/staff'
];

function getTitle(html) {
    const match = html.match(/<h1[^>]*>(.*?)<\/h1>/);
    if (match) {
        return match[1].replace(/<\/h1/, '').trim();
    }
    return 'Page Title';
}

function processDirectory(dir) {
    if (!fs.existsSync(dir)) return;
    
    fs.readdirSync(dir).forEach(file => {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            processDirectory(fullPath);
        } else if (file.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let original = content;

            // Replace extends
            content = content.replace(/@extends\(['"][^'"]*['"]\)/g, "@extends('layouts.app')");

            // Extract title and inject section if missing
            if (!content.includes("@section('title'")) {
                const title = getTitle(content);
                content = content.replace("@extends('layouts.app')", `@extends('layouts.app')\n@section('title', '${title}')`);
            }

            // Make UI clean if it's the basic p-8 one
            if (content.includes('<div class="p-8">') && !content.includes('class="bg-white')) {
                content = content.replace('<div class="p-8">', '<div class="max-w-7xl mx-auto py-8 px-4">\n    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8">');
                content = content.replace('</h1></div>', '</h1>\n        <div class="mt-4 text-gray-600">\n            Content for this page will be displayed here.\n        </div>\n    </div>\n</div>');
            }

            if (content !== original) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated ${fullPath}`);
            }
        }
    });
}

dirs.forEach(processDirectory);
console.log('All done!');
