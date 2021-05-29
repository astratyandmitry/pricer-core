<header class="bg-gray-800 shadow-sm py-3">
  <div class="container mx-auto px-2">
    <div class="flex items-center justify-center md:justify-between">
      <a href="{{ route('home') }}" class="text-gray-400 text-2xl select-none">
        ASTRAtech <span class="text-white font-medium">Pricer</span>
      </a>

      <ul class="flex items-center text-sm space-x-6 hidden md:block">
        <li class="text-gray-200 hover:text-white">
          <a href="{{ route('subscription.list') }}">Поисковые запросы</a>
        </li>
      </ul>
    </div>
  </div>
</header>
