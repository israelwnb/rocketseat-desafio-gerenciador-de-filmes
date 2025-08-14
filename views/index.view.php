<div class="mx-auto max-w-screen px-24">
  <div class="flex justify-between items-center mt-12">
    <h1 class="font-display text-3xl text-gray-100">Explorar</h1>

    <form class="w-80">
      <div class="relative">
        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xl text-gray-300 has-[+.filled]:text-purple-light"></i>
        <input
          type="text"
          name="pesquisar"
          class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
          placeholder="Pesquisar filme...">
      </div>
    </form>
  </div>

  <section class="mt-12 flex flex-col items-center justify-center gap-4">
    <?php if (!$filmes) : ?>
      <i class="ph ph-film-slate text-gray-400 text-5xl"></i>
      <div class="text-gray-200 text-base text-center">
        <p>Nenhum filme encontrado<?= isset($_GET["pesquisar"]) ? " com \"" .  $_GET['pesquisar'] . "\"<br>Que tal tentar outra busca?" : "" ?></p>
      </div>
      <?php if (isset($_GET["pesquisar"])) : ?>
        <div class="text-gray-300 hover:text-purple-light transition-colors flex items-center justify-center text-base">
          <a href="/" class="flex items-center gap-2">
            <i class="ph ph-x" style="transform: translateY(1px);"></i>
            <span>Limpar filtro</span>
          </a>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </section>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
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
  });
</script>