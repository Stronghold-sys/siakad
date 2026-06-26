@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between py-4">
        <!-- Mobile View (Prev/Next buttons, touch target min 44px) -->
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 border border-border-subtle bg-bg-app text-text-muted rounded-sm text-sm font-medium cursor-not-allowed select-none min-h-[44px] inline-flex items-center">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 border border-border-core bg-surface text-text-primary hover:bg-bg-app rounded-sm text-sm font-medium transition-colors duration-150 min-h-[44px] inline-flex items-center">
                    Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 border border-border-core bg-surface text-text-primary hover:bg-bg-app rounded-sm text-sm font-medium transition-colors duration-150 min-h-[44px] inline-flex items-center">
                    Berikutnya
                </a>
            @else
                <span class="px-4 py-2 border border-border-subtle bg-bg-app text-text-muted rounded-sm text-sm font-medium cursor-not-allowed select-none min-h-[44px] inline-flex items-center">
                    Berikutnya
                </span>
            @endif
        </div>

        <!-- Desktop View (Structured flat border, 4px radius) -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-xs text-text-secondary">
                    Menampilkan
                    <span class="font-semibold text-text-primary">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-semibold text-text-primary">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-semibold text-text-primary">{{ $paginator->total() }}</span>
                    mahasiswa
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-raised rounded-sm overflow-hidden border border-border-core bg-surface p-1 gap-1">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-text-muted cursor-not-allowed select-none rounded-sm min-h-[36px]" aria-hidden="true">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-text-secondary hover:text-text-primary hover:bg-bg-app rounded-sm transition-colors duration-150 min-h-[36px]" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-text-muted cursor-default select-none" aria-disabled="true">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-brand-blue rounded-sm select-none min-h-[36px] shadow-sm">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-text-secondary hover:text-text-primary hover:bg-bg-app rounded-sm transition-colors duration-150 min-h-[36px]" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-text-secondary hover:text-text-primary hover:bg-bg-app rounded-sm transition-colors duration-150 min-h-[36px]" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-text-muted cursor-not-allowed select-none rounded-sm min-h-[36px]" aria-hidden="true">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
