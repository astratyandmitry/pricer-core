<div class="bg-black bg-opacity-70 inset-0 fixed w-screen h-screen flex z-50 items-center justify-center hidden">
  <div class="bg-white w-4/12 p-12 rounded-md shadow-xl">
    <h1 class="text-2xl font-medium">
      Новый поисковой запрос
    </h1>

    <form action="{{ route('query.new') }}" method="post" class="mt-6 space-y-3">
      @csrf

      <div>
        <label for="title" class="block mb-1 text-gray-600 text-sm font-medium">Название</label>
        <input id="title" type="text" name="title" placeholder="Алматы камри 30 на бензине" class="bg-gray-100 p-3 block rounded w-full">
      </div>

      <div>
        <label for="title" class="block mb-1 text-gray-600 text-sm font-medium">URL</label>
        <input id="title" type="text" name="title" placeholder="https://kolesa.kz/..." class="bg-gray-100 p-3 block rounded w-full">
      </div>

      <p>
        <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded">
          Сохранить запрос
        </button>
      </p>
    </form>

  </div>

</div>

