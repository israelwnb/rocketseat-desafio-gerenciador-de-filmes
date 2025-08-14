<form method="post" action="/filme-criar" enctype="multipart/form-data">
  <div class="mx-auto max-w-screen px-40">
    <div class="flex mt-12 gap-12 w-full">
      <?php $validacoes = flash()->get('validacoes') ?>
      <!-- Upload de Imagem -->
      <div class="w-1/3 bg-gray-600 rounded-lg p-8 flex flex-col items-center justify-center min-h-96 border-2 border-dashed border-gray-500 hover:border-purple-light transition-colors cursor-pointer relative" id="upload-area">
        <div id="upload-content" class="flex flex-col items-center justify-center">
          <i class="ph ph-upload-simple text-purple-light text-6xl mb-4"></i>
          <span class="text-gray-300 text-lg">Fazer upload</span>
        </div>
        <input type="file" name="imagem" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" id="file-input">
      </div>

      <!-- Formulário -->
      <div class="w-2/3 space-y-6">
        <div class="flex justify-between items-center">
          <h1 class="font-title font-bold text-3xl text-gray-100">Novo filme</h1>
        </div>
        <!-- Campo Título -->
        <div class="flex flex-col gap-2">
          <div class="relative">
            <i class="ph ph-film-slate absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["titulo"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
            <input
              type="text"
              name="titulo"
              class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
              placeholder="Título" />
          </div>
          <?php if (isset($validacoes["titulo"])) : ?>
            <?php foreach ($validacoes["titulo"] as $validacao) : ?>
              <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Campos Ano e Categoria -->
        <div class="grid grid-cols-2 gap-4">
          <!-- Campo Ano -->
          <div class="flex flex-col gap-2">
            <div class="relative">
              <i class="ph ph-calendar-blank absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["ano"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
              <input
                type="text"
                name="ano"
                inputmode="numeric"
                class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
                placeholder="Ano" />
            </div>
            <?php if (isset($validacoes["ano"])) : ?>
              <?php foreach ($validacoes["ano"] as $validacao) : ?>
                <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- Campo Categoria -->
          <div class="flex flex-col gap-2">
            <div class="relative">
              <i class="ph ph-tag absolute left-3 top-1/2 -translate-y-1/2 text-xl <?= isset($validacoes["categoria"]) ? 'text-error-base' : 'text-gray-300 has-[+.filled]:text-purple-light' ?>"></i>
              <input
                type="text"
                name="categoria"
                class="font-body bg-gray-700 border border-gray-500 rounded p-3 pl-10 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
                placeholder="Categoria" />
            </div>
            <?php if (isset($validacoes["categoria"])) : ?>
              <?php foreach ($validacoes["categoria"] as $validacao) : ?>
                <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <!-- Descrição -->
        <div class="flex flex-col gap-2">
          <textarea
            name="descricao"
            rows="8"
            class="resize-none font-body bg-gray-700 border border-gray-500 rounded p-3 pl-4 text-white placeholder-gray-300 placeholder-shown:placeholder-gray-300 focus:placeholder-transparent focus:outline-none focus:border-2 focus:border-purple-base caret-gray-300 w-full text-lg"
            placeholder="Descrição"></textarea>
          <?php if (isset($validacoes["descricao"])) : ?>
            <?php foreach ($validacoes["descricao"] as $validacao) : ?>
              <p class="text-sm text-error-light"><i class="ph ph-warning"></i> <?= $validacao ?></p>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Botões -->
        <div class="flex justify-end gap-4 pt-4">
          <button
            id="botao-cancelar"
            type="reset"
            class="px-6 py-3 text-gray-300 hover:text-purple-light transition-colors">
            Cancelar
          </button>
          <button
            type="submit"
            class="bg-purple-base text-white rounded py-3 px-6 font-body font-semibold text-lg hover:bg-purple-light hover:shadow-lg hover:shadow-purple-light/50 transition-all">
            Salvar
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  // Handle file upload
  const uploadArea = document.getElementById('upload-area');
  const fileInput = document.getElementById('file-input');

  uploadArea.addEventListener('click', () => {
    fileInput.click();
  });

  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('border-purple-light');
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('border-purple-light');
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('border-purple-light');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      fileInput.files = files;
      handleFileUpload(files[0]);
    }
  });

  fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
      handleFileUpload(e.target.files[0]);
    }
  });

  function handleFileUpload(file) {
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = (e) => {
        // Update only the content div, keeping the input in place
        const uploadContent = document.getElementById('upload-content');
        uploadContent.innerHTML = `
          <div class="w-full h-full flex items-center justify-center">
            <img src="${e.target.result}" alt="Preview" class="max-w-full max-h-full object-contain rounded">
          </div>
        `;
      };
      reader.readAsDataURL(file);
    }
  }

  // Handle filled state for inputs
  const inputs = document.querySelectorAll('input[type="text"]');
  const textarea = document.querySelector('textarea');
  const botaoCancelar = document.getElementById('botao-cancelar');

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

  // Handle cancel button
  botaoCancelar.addEventListener('click', (e) => {
    e.preventDefault();
    // Clear all inputs
    inputs.forEach(input => {
      input.value = '';
      input.classList.remove('filled');
      const clearButton = input.parentElement.querySelector('.clear-button');
      if (clearButton) {
        clearButton.classList.add('hidden');
      }
    });
    // Clear textarea
    if (textarea) {
      textarea.value = '';
    }
    // Clear file input and reset upload area
    fileInput.value = '';
    const uploadContent = document.getElementById('upload-content');
    uploadContent.innerHTML = `
      <i class="ph ph-upload-simple text-purple-light text-6xl mb-4"></i>
      <span class="text-gray-300 text-lg">Fazer upload</span>
    `;
  });
</script>