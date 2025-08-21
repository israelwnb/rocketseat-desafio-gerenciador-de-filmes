<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Rajdhani:wght@300;400;500;600;700&family=Rammetto+One&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'purple-base': '#892CCD',
            'purple-light': '#A85FDD',
            'error-base': '#D04048',
            'error-light': '#F77980',
            'gray-700': '#0F0F1A',
            'gray-600': '#131320',
            'gray-500': '#1A1B2D',
            'gray-400': '#45455F',
            'gray-300': '#7A7B9F',
            'gray-200': '#B5B6C9',
            'gray-100': '#E4E5EC',
            'white': '#FFFFFF'
          },
          fontFamily: {
            display: ['Rammetto One'],
            title: ['Rajdhani'],
            body: ['Nunito Sans'],
          },
          backgroundImage: {
            'login': "url('/assets/login.png')",
            'logo': "url('/assets/logo.svg')",
          }
        }
      }
    }
  </script>

  <title>Gerenciador de Filmes</title>
</head>

<body class="bg-gray-700">
  <?php if (auth()) : ?>
    <header class="bg-gray-600">
      <div class="mx-auto max-w-screen px-6 py-3">
        <nav class="flex items-center justify-between">
          <img class="h-12" src="assets\logo.svg" alt="ab filmes" />
          <div class="absolute left-1/2 transform -translate-x-1/2 flex gap-4">
            <a href="/" id="btn-explorar" class="p-2 rounded font-body text-gray-300 text-lg hover:bg-gray-500 transition-colors"><i class="ph ph-popcorn"></i> Explorar</a>
            <a href="/meus-filmes" id="btn-meus-filmes" class="p-2 rounded font-body text-gray-300 text-lg hover:bg-gray-500 transition-colors"><i class="ph ph-film-slate"></i> Meus filmes</a>
          </div>

          <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
              <span class="text-gray-200 font-body">Olá, <?= auth()->nome ?></span>
              <div class="h-8 aspect-square rounded-lg bg-gradient-to-br from-purple-base to-purple-light flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                <?= strtoupper(substr(auth()->nome, 0, 1)) ?>
              </div>
            </div>
            <div class="w-px h-6 bg-gray-500"></div>
            <a href="/logout" class="p-2 rounded bg-gray-500 text-gray-300 hover:text-purple-light hover:bg-gray-500 transition-colors flex items-center justify-center text-lg">
              <i class="ph ph-sign-out"></i>
            </a>
          </div>
        </nav>
      </div>
    </header>
  <?php endif; ?>

  <main class="mx-auto h-fit overflow-hidden">
    <?php require "../views/{$view}.view.php"; ?>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let menu = "<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>"
      menu = menu.slice(1);

      if (menu == "") {
        const botao = document.getElementById('btn-explorar');

        botao.classList.remove('text-gray-300', 'hover:bg-gray-500', 'transition-colors');
        botao.classList.add('bg-gray-500', 'text-purple-light');
      } else if (menu == "meus-filmes") {
        const botao = document.getElementById('btn-meus-filmes');

        botao.classList.remove('text-gray-300', 'hover:bg-gray-500', 'transition-colors');
        botao.classList.add('bg-gray-500', 'text-purple-light');
      }
    });
  </script>
</body>

</html>