<div class="min-h-screen bg-gray-700 px-80">
  <!-- Conteúdo -->
  <div class="min-h-screen text-white">

    <!-- Layout principal - Imagem e Informações (Full Width) -->
    <div class="relative bg-[url(<?= $filme->imagem ?>)] bg-cover bg-center flex gap-12 overflow-hidden pt-16 pb-20 h-[640px] -mx-80 px-80">
      <!-- Overlay para diminuir opacidade da imagem de fundo -->
      <div id="image" class="absolute inset-0 bg-gradient-to-t from-gray-700/100 to-gray-700/95"></div> <!-- Imagem do filme (card menor) -->
      <div class="aspect-[7/9] relative z-10 rounded-2xl overflow-hidden ml-20">
        <img
          src="<?= $filme->imagem ?>"
          alt="<?= htmlspecialchars($filme->titulo) ?>"
          class="w-full h-full object-cover rounded-2xl">
      </div>

      <!-- Informações do filme -->
      <div class="relative z-10 flex flex-col flex-1 py-4 pr-20">
        <div class="space-y-4">
          <div>
            <div class="text-gray-300 hover:text-purple-light transition-colors flex items-center text-base mb-4">
              <a href="/" class="flex items-center gap-2">
                <i class="ph ph-arrow-left" style="transform: translateY(1px);"></i>
                <span>Voltar</span>
              </a>
            </div>

            <h1 class="text-4xl font-bold font-title text-gray-100 mb-4">
              <?= htmlspecialchars($filme->titulo) ?>
            </h1>

            <div class="space-y-2 text-gray-200 text-body">
              <p><span class="font-bold">Categoria:</span> <?= htmlspecialchars($filme->categoria) ?></p>
              <p><span class="font-bold">Ano:</span> <?= $filme->ano ?></p>
            </div>
          </div>

          <!-- Sistema de avaliação -->
          <div class="flex items-center space-x-2">
            <div class="flex space-x-1">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <?php if ($i <= $filme->nota_avaliacao): ?>
                  <i class="ph-fill ph-star text-purple-light text-xl"></i>
                <?php else : ?>
                  <i class="ph ph-star text-purple-light text-xl"></i>
                <?php endif; ?>
              <?php endfor; ?>
            </div>
            <span class="text-gray-100 text-2xl font-title font-bold pl-1"><?= $filme->nota_avaliacao ?? 0 ?></span>
            <span class="text-gray-200 text-base">(<?= $filme->count_avaliacoes ?? 0 ?> avaliações)</span>
          </div>
        </div>

        <!-- Descrição -->
        <div class="mt-12">
          <p class="text-gray-200 leading-relaxed text-base">
            <?= htmlspecialchars($filme->descricao) ?>
          </p>
        </div>
      </div>
    </div>

    <!-- Container para a seção de avaliações -->
    <div class="mx-auto max-w-7xl px-20">
      <!-- Seção de Avaliações -->
      <div class="border-t border-gray-600 pt-20 pb-36 flex-1">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold font-title text-white">Avaliações</h2>
          <button onclick="openModal()" class="bg-purple-base text-white rounded py-3 px-4 font-body font-semibold text-lg hover:bg-purple-light hover:shadow-lg hover:shadow-purple-light/50 transition-colors">
            <i class="ph ph-star"></i> Avaliar filme
          </button>
        </div>

        <!-- Estado vazio de avaliações -->
        <?php if (!$avaliacoes): ?>
          <section class="mt-12 flex flex-col items-center justify-center gap-4">
            <i class="ph ph-popcorn text-gray-400 text-5xl"></i>
            <div class="text-gray-200 text-base text-center">
              <p>Nenhuma avaliação registrada.<br>Que tal enviar o primeiro comentário?</p>
            </div>
            <div class="text-gray-300 hover:text-purple-light transition-colors flex items-center justify-center text-base">
              <button onclick="openModal()" class="flex items-center gap-2">
                <i class="ph ph-star" style="transform: translateY(1px);"></i>
                <span>Avaliar filme</span>
              </button>
            </div>
          </section>
        <?php else: ?>
          <!-- Lista de Avaliações -->
          <div class="space-y-6">
            <?php foreach ($avaliacoes as $avaliacao): ?>
              <div class="flex gap-10 bg-gray-600 rounded-lg p-8">
                <div class="flex gap-4 w-48 flex-shrink-0">
                  <!-- Avatar do usuário -->
                  <div class="h-12 aspect-square rounded-lg bg-gradient-to-br from-purple-base to-purple-light flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                    <?= strtoupper(substr($avaliacao->usuario_nome, 0, 1)) ?>
                  </div>
                  <!-- Nome do usuário e badge -->
                  <div>
                    <div class="flex items-center gap-3">
                      <h4 class="text-gray-100 font-semibold text-md"><?= htmlspecialchars($avaliacao->usuario_nome) ?></h4>
                      <?php if ($avaliacao->usuario_id == auth()->id) : ?>
                        <span class="bg-purple-base text-gray-100 text-xs px-2 py-1 rounded-full font-bold">você</span>
                      <?php endif; ?>
                    </div>
                    <span class="text-gray-300 text-sm"><?= $avaliacao->usuario_filmes_avaliados ?> filme<?= $avaliacao->usuario_filmes_avaliados > 1 ? 's' : '' ?> avaliado<?= $avaliacao->usuario_filmes_avaliados > 1 ? 's' : '' ?></span>
                  </div>
                </div>
                <div class="w-px self-stretch bg-gray-500"></div>
                <!-- Conteúdo da avaliação -->
                <div class="flex-1">
                  <!-- Comentário -->
                  <p class="text-gray-300 text-base leading-relaxed mb-3">
                    <?= htmlspecialchars($avaliacao->comentario) ?>
                  </p>
                </div>

                <!-- Nota com estrelas -->
                <div class="bg-gray-500 rounded-lg px-3 py-1 flex items-center gap-1 h-fit">
                  <span class="text-gray-100 text-lg font-bold"><?= $avaliacao->nota ?></span>
                  <div class="item-end">
                    <span class="text-gray-200 text-xs">/ 5</span>
                  </div>
                  <div>
                    <i class="ph-fill ph-star text-purple-light text-base"></i>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Modal de Avaliação -->
  <?php $validacoes = flash()->get('validacoes') ?>
  <div id="modalAvaliacao" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-xs flex items-center justify-center z-50 <?= $validacoes ? '' : 'hidden' ?>">
    <form action="/avaliacao-criar" method="POST">
      <div class="bg-gray-700 rounded-2xl p-8 max-w-2xl w-full mx-4 relative $where, $params">
        <!-- Botão fechar -->
        <button type="button" onclick="closeModal()" class="absolute top-4 right-4 p-2 rounded bg-gray-500 text-gray-300 hover:text-purple-light hover:bg-gray-500 transition-colors flex items-center justify-center text-2xl">
          <i class="ph ph-x"></i>
        </button>

        <!-- Título -->
        <h2 class="text-2xl font-bold font-title text-white mb-6">Avaliar filme</h2>

        <!-- Informações do filme -->
        <div class="flex gap-6 mb-6 items-start">
          <div class="aspect-[7/9] flex-shrink-0 w-36">
            <img
              src="<?= $filme->imagem ?>"
              alt="<?= htmlspecialchars($filme->titulo) ?>"
              class="w-full h-full object-cover rounded-lg">
          </div>
          <div class="flex-1 pr-36">
            <h3 class="text-2xl font-bold font-title text-gray-100">
              <?= htmlspecialchars($filme->titulo) ?>
            </h3>
            <div class="text-gray-200 text-body text-sm my-4">
              <p><span class="font-bold">Categoria:</span> <?= htmlspecialchars($filme->categoria) ?></p>
              <p><span class="font-bold">Ano:</span> <?= $filme->ano ?></p>
            </div>

            <!-- Sistema de estrelas -->
            <div class="pt-2">
              <input type="hidden" name="filme_id" value="<?= $filme->id ?>">
              <label class="block font-body text-sm text-gray-200 mb-2">Sua avaliação:</label>
              <div class="flex">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <button type="button" onclick="setRating(<?= $i ?>)" class="star text-3xl text-purple-light hover:text-purple-base transition-all duration-200 star-button relative w-10 h-10 rounded-full hover:bg-gray-500 flex items-center justify-center">
                    <i class="ph ph-star star-outline absolute"></i>
                    <i class="ph-fill ph-star star-filled absolute"></i>
                  </button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="nota" id="rating" value="">
            </div>
          </div>
        </div>

        <!-- Campo de comentário -->
        <div class="flex flex-col gap-2">
          <textarea
            name="comentario"
            rows="5"
            class="resize-none font-body bg-gray-700 border border-gray-500 rounded p-3 pl-4 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
            placeholder="Comentário"></textarea>
          <?php if (isset($validacoes["comentario"])) : ?>
            <?php foreach ($validacoes["comentario"] as $validacao) : ?>
              <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Botão publicar -->
        <div class="flex justify-end mt-4">
          <button
            type="submit"
            class="bg-purple-base text-white rounded py-3 px-6 font-body text-base hover:bg-purple-light hover:shadow-lg hover:shadow-purple-light/50 transition-all">
            Publicar
          </button>
        </div>
    </form>
  </div>
</div>

<style>
  /* Star hover effect - overlay icons properly */
  .star-button .star-outline,
  .star-button .star-filled {
    transition: opacity 0.2s ease;
  }

  .star-button .star-filled {
    opacity: 0;
  }

  .star-button .star-outline {
    opacity: 1;
  }

  .star-button:hover .star-outline {
    opacity: 0;
  }

  .star-button:hover .star-filled {
    opacity: 1;
  }
</style>
</div>

<script>
  // Check if modal should be open on page load due to validation errors
  <?php if ($validacoes): ?>
    document.body.style.overflow = 'hidden';
    document.querySelector('.min-h-screen.text-white').classList.add('blur-sm');
  <?php endif; ?>

  // Funções do Modal
  function openModal() {
    document.getElementById('modalAvaliacao').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    // Add blur to main content
    document.querySelector('.min-h-screen.text-white').classList.add('blur-sm');
  }

  function closeModal() {
    document.getElementById('modalAvaliacao').classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Remove blur from main content
    document.querySelector('.min-h-screen.text-white').classList.remove('blur-sm');
    // Reset rating
    resetRating();
  }

  // Sistema de estrelas
  let currentRating = 0;

  function setRating(rating) {
    currentRating = rating;
    document.getElementById('rating').value = rating;
    updateStars();
  }

  function updateStars() {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
      const icon = star.querySelector('i');
      if (index < currentRating) {
        icon.className = 'ph-fill ph-star';
        star.classList.add('text-purple-light');
        star.classList.remove('text-gray-400');
      } else {
        icon.className = 'ph ph-star';
        star.classList.remove('text-purple-base');
        star.classList.add('text-gray-400');
      }
    });
  }

  function resetRating() {
    currentRating = 0;
    document.getElementById('rating').value = '';
    updateStars();
  }

  // Fechar modal clicando fora
  document.getElementById('modalAvaliacao').addEventListener('click', function(e) {
    if (e.target === this) {
      closeModal();
    }
  });

  // Fechar modal com ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeModal();
    }
  });
</script>