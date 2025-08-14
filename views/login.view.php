<?php //dd(flash()->get('validacoes_login')) 
?>

<div class="h-screen grid grid-cols-2 gap-2 p-6">
  <div class="flex flex-col bg-login bg-cover bg-bottom w-full pt-12 pb-16 px-12 justify-between rounded-3xl">
    <img class="h-24 w-24" src="assets\logo.svg" alt="ab filmes" />
    <div class="space-y-8">
      <h2 class="font-display text-gray-200 text-xl">ab filmes</h2>
      <p class="font-display text-gray-100 text-3xl w-2/3">O guia definitivo para os amantes do cinema</p>
    </div>
  </div>

  <div class="p-8 flex flex-col">
    <nav class="w-96 mx-auto mb-12 mt-36">
      <div class="flex gap-1 justify-between bg-gray-600 p-1 rounded-md">
        <button id="botao-login" class="w-1/2 bg-gray-600 text-gray-300 text-center px-4 py-2 rounded-md">Login</button>
        <button id="botao-cadastro" class="w-1/2 bg-gray-600 text-gray-300 text-center px-4 py-2 rounded-md">Cadastro</button>
      </div>
    </nav>

    <div class="relative w-full overflow-hidden mt-6">
      <div class="flex w-[200%] transition-transform duration-300 ease-in-out">
        <!-- Form Login -->
        <?php $validacoes = flash()->get('validacoes_login') ?>
        <div class="w-1/2 flex-shrink-0">
          <div id="form-login" class="max-w-md mx-auto">
            <h1 class="font-display text-gray-100 text-3xl mb-8">Acesse sua conta</h1>

            <form method="POST" action="/login" class="flex flex-col gap-6">
              <div class="flex flex-col gap-2">
                <div class="relative">
                  <i class="ph ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["email"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
                  <input
                    type="email"
                    name="email"
                    class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg has-filled:border-purple-light "
                    placeholder="E-mail" />

                </div>
                <?php if (isset($validacoes["email"])) : ?>
                  <?php foreach ($validacoes["email"] as $validacao) : ?>
                    <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <div class="flex flex-col gap-2">
                <div class="relative">
                  <i class="ph ph-password absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["senha"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
                  <input
                    type="password"
                    name="senha"
                    class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
                    placeholder="Senha" />
                </div>
                <?php if (isset($validacoes["senha"])) : ?>
                  <?php foreach ($validacoes["senha"] as $validacao) : ?>
                    <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <button type="submit" class="bg-purple-base text-white rounded py-3 px-4 mt-4 font-title font-semibold text-lg hover:bg-purple-light hover:shadow-lg hover:shadow-purple-light/50 transition-colors">
                Entrar
              </button>
            </form>
          </div>
        </div>

        <!-- Form Cadastro -->
        <?php $validacoes = flash()->get('validacoes_registrar') ?>
        <div class="w-1/2 flex-shrink-0">
          <div id="form-cadastro" class="max-w-md mx-auto">
            <h1 class="font-display text-gray-100 text-3xl mb-8">Crie sua conta</h1>

            <form method="POST" action="/registrar" class="flex flex-col gap-6">
              <div class="flex flex-col gap-2">
                <div class="relative">
                  <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["nome"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
                  <input
                    type="text"
                    name="nome"
                    class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
                    placeholder="Nome" />
                </div>
                <?php if (isset($validacoes["nome"])) : ?>
                  <?php foreach ($validacoes["nome"] as $validacao) : ?>
                    <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <div class="flex flex-col gap-2">
                <div class="relative">
                  <i class="ph ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["email"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
                  <input
                    type="email"
                    name="email"
                    class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
                    placeholder="E-mail" />
                </div>
                <?php if (isset($validacoes["email"])) : ?>
                  <?php foreach ($validacoes["email"] as $validacao) : ?>
                    <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <div class="flex flex-col gap-2">
                <div class="relative">
                  <i class="ph ph-password absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["senha"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
                  <input
                    type="password"
                    name="senha"
                    class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
                    placeholder="Senha" />
                </div>
                <?php if (isset($validacoes["senha"])) : ?>
                  <?php foreach ($validacoes["senha"] as $validacao) : ?>
                    <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <button type="submit" class="bg-purple-base text-white rounded py-3 px-4 mt-4 font-title font-semibold text-lg hover:bg-purple-light hover:shadow-lg hover:shadow-purple-light/50 transition-colors">
                Criar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let selecionado = '';
    const botaoLogin = document.getElementById('botao-login');
    const botaoCadastro = document.getElementById('botao-cadastro');
    const formLogin = document.getElementById('form-login');
    const formCadastro = document.getElementById('form-cadastro');

    // Handle filled state for inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
      const clearButton = document.createElement('button');
      clearButton.type = 'button';
      clearButton.className = 'clear-button absolute right-3 top-1/2 -translate-y-1/2 hidden';
      clearButton.innerHTML = '<i class="ph ph-x text-xs p-1 bg-gray-300 text-gray-700 rounded-full"></i>';
      input.parentElement.appendChild(clearButton);

      // Clear input value
      clearButton.addEventListener('click', (e) => {
        e.preventDefault();
        input.value = '';
        input.classList.remove('filled');
        clearButton.classList.add('hidden');
        input.focus();
      });

      // Check initial state
      if (input.value.trim() !== '') {
        input.classList.add('filled');
        clearButton.classList.remove('hidden');
      }

      // Handle input events
      input.addEventListener('input', () => {
        if (input.value.trim() !== '') {
          input.classList.add('filled');
          clearButton.classList.remove('hidden');
        } else {
          input.classList.remove('filled');
          clearButton.classList.add('hidden');
        }
      });
    });

    init();

    const formContainer = document.querySelector('.flex.transition-transform');

    // Mudar para Cadastrar
    botaoCadastro.addEventListener('click', function(e) {
      e.preventDefault();
      if (selecionado == 'login') {
        selecionado = 'cadastrar';
        botaoCadastro.classList.remove('text-gray-300', 'bg-gray-600');
        botaoCadastro.classList.add('text-purple-light', 'bg-gray-500');
        botaoLogin.classList.remove('text-purple-light', 'bg-gray-500');
        botaoLogin.classList.add('text-gray-300', 'bg-gray-600');

        // Animação de slide
        formContainer.style.transform = 'translateX(-50%)';
      }
    });

    // Mudar para Login
    botaoLogin.addEventListener('click', function(e) {
      e.preventDefault();
      if (selecionado == 'cadastrar') {
        selecionado = 'login';
        botaoLogin.classList.remove('text-gray-300', 'bg-gray-600');
        botaoLogin.classList.add('text-purple-light', 'bg-gray-500');
        botaoCadastro.classList.remove('text-purple-light', 'bg-gray-500');
        botaoCadastro.classList.add('text-gray-300', 'bg-gray-600');

        // Animação de slide
        formContainer.style.transform = 'translateX(0)';
      }
    });

    function init() {
      const formContainer = document.querySelector('.flex.transition-transform');
      <?php if (flash()->get('pagina') == 'cadastrar') : ?>
        selecionado = 'cadastrar';

        botaoCadastro.classList.remove('text-gray-300', 'bg-gray-600');
        botaoCadastro.classList.add('text-purple-light', 'bg-gray-500');
        formContainer.style.transform = 'translateX(-50%)';
      <?php else : ?>
        selecionado = 'login';

        botaoLogin.classList.remove('text-gray-300', 'bg-gray-600');
        botaoLogin.classList.add('text-purple-light', 'bg-gray-500');
        formContainer.style.transform = 'translateX(0)';
      <?php endif; ?>
    }
  });
</script>