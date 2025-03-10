<!DOCTYPE html>
<html <?php language_attributes(); ?> class="font-inter bg-bg text-fg scroll-smooth">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col h-dvh') ?>>
  <?php wp_body_open(); ?>
  <header class="sticky top-0 z-10 py-6">
    <div class="container flex items-center lg:grid lg:grid-cols-[1fr_auto_1fr]">
      <div class="flex items-center">
        <a href="/" class="inline-block">
            logo
        </a>
      </div>
      <ul class="flex items-center gap-10 max-lg:hidden">
        <li>
          <a href="#" class="group relative py-2">
            <span class="transition-opacity duration-300">Home</span>
            <span class="absolute top-full left-1/2 h-0.5 -translate-x-1/2 bg-current transition-[width] duration-300 w-0 group-hover:w-3/4"></span>
          </a>
        </li>
        <li>
          <a href="#" class="group relative py-2">
            <span class="transition-opacity duration-300">About us</span>
            <span class="absolute top-full left-1/2 h-0.5 -translate-x-1/2 bg-current transition-[width] duration-300 w-0 group-hover:w-3/4"></span>
          </a>
        </li>
        <li>
          <a href="#" class="group relative py-2">
            <span class="transition-opacity duration-300">Contact us</span>
            <span class="absolute top-full left-1/2 h-0.5 -translate-x-1/2 bg-current transition-[width] duration-300 w-0 group-hover:w-3/4"></span>
          </a>
        </li>
        <li>
          <a href="#" class="group relative py-2">
            <span class="transition-opacity duration-300">Blog</span>
            <span class="absolute top-full left-1/2 h-0.5 -translate-x-1/2 bg-current transition-[width] duration-300 w-0 group-hover:w-3/4"></span>
          </a>
        </li>
      </ul>
      <div class="ms-auto flex items-center gap-6">
        <a href="#" class="btn" data-color="primary" data-size="medium">Join us</a>
      </div>
    </div>
  </header>
  <main class="grow px-4 py-4">