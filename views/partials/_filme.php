<a href="/filme?id=<?= $filme->id ?>" class="relative bg-gray-600 rounded-lg overflow-hidden group cursor-pointer">
  <!-- Imagem do filme -->
  <div class="aspect-[7/9] relative">
    <img
      src="<?= $filme->imagem ?>"
      alt="<?= htmlspecialchars($filme->titulo) ?>"
      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

    <!-- Overlay com gradiente -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

    <!-- Hover dim effect -->
    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Nota de avaliação -->
    <div class="absolute top-3 right-3 bg-black/80 rounded-full px-3 py-1 flex items-center gap-1">
      <span class="text-gray-100 text-lg font-bold"><?= $filme->nota ?? '4,5' ?></span>
      <div class="item-end">
        <span class="text-gray-200 text-xs">/5</span>
      </div>
      <div>
        <i class="ph-fill ph-star text-white text-base"></i>
      </div>
    </div>
  </div>

  <!-- Informações do filme que deslizam juntas no hover -->
  <div class="absolute bottom-0 left-0 right-0 px-4 text-white transform translate-y-20 group-hover:translate-y-0 transition-transform duration-300 ease-out bg-gradient-to-t from-black/60 to-transparent">
    <div>
      <h3 class="font-semibold font-title text-xl mb-1 line-clamp-2 leading-tight">
        <?= htmlspecialchars($filme->titulo) ?>
      </h3>

      <div class="flex items-center gap-1 text-base font-body font-bold text-gray-200 mb-3">
        <span><?= htmlspecialchars($filme->categoria) ?></span>
        <span>•</span>
        <span><?= $filme->ano ?></span>
      </div>

      <p class="text-base text-gray-200 leading-relaxed line-clamp-3 invisible group-hover:visible mb-3">
        <?= htmlspecialchars($filme->descricao) ?>
      </p>
    </div>
  </div>
</a>