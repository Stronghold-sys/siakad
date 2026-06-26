<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAKAD</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230286C3' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M12 14l9-5-9-5-9 5 9 5z'/%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'/%3E%3C/svg%3E">
    
    <!-- Google Fonts: Avenir Next font family fallback or Outfit for visual similarities -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (Play CDN for instant out-of-the-box styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            blue: '#0286C3',
                            blueDark: '#0073AA',
                            teal: '#17B897',
                        },
                        text: {
                            primary: '#1B1E28',
                            secondary: '#536171',
                            muted: '#8DA4BE',
                        },
                        bg: {
                            app: '#F7F9FA',
                        },
                        surface: '#FFFFFF',
                        border: {
                            core: '#CFD9E0',
                            subtle: '#E5EBED',
                        },
                        semantic: {
                            success: '#17B897',
                            warning: '#F5A623',
                            error: '#D32F2F',
                            info: '#0286C3',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                        mono: ['monospace'],
                    },
                    borderRadius: {
                        sm: '4px',
                        md: '6px',
                    },
                    boxShadow: {
                        raised: '0 1px 2px rgba(0,0,0,0.1)',
                        overlay: '0 4px 8px rgba(0,0,0,0.12)',
                        modal: '0 8px 24px rgba(0,0,0,0.15)',
                    },
                    spacing: {
                        'tight-gap': '4px',
                        'form-pad': '8px',
                        'btn-pad': '12px',
                        'card-pad': '16px',
                        'sec-sep': '24px',
                        'comp-block': '32px',
                        'page-sec': '48px',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lottie Files Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    <!-- CSS Variables Mapping from design-tokens.json -->
    <style>
        :root {
            --color-brand-blue: #0286C3;
            --color-brand-blue-dark: #0073AA;
            --color-brand-teal: #17B897;
            --color-text-primary: #1B1E28;
            --color-text-secondary: #536171;
            --color-text-muted: #8DA4BE;
            --color-bg-app: #F7F9FA;
            --color-surface: #FFFFFF;
            --color-border-core: #CFD9E0;
            --color-border-subtle: #E5EBED;
            
            --font-sans: 'Outfit', -apple-system, sans-serif;
            --radius-sm: 4px;
            --radius-md: 6px;
            
            --shadow-raised: 0 1px 2px rgba(0,0,0,0.1);
            --shadow-overlay: 0 4px 8px rgba(0,0,0,0.12);
            --shadow-modal: 0 8px 24px rgba(0,0,0,0.15);
        }
        body {
            font-family: var(--font-sans);
            background-color: var(--color-bg-app);
            color: var(--color-text-primary);
        }
        /* Class helper for exact Design Tokens styling */
        .token-card {
            background-color: var(--color-surface);
            border: 1px solid var(--color-border-subtle);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-raised);
            padding: 16px;
        }
        .token-input {
            border: 1px solid var(--color-border-core);
            border-radius: var(--radius-sm);
            padding: 8px 12px;
            font-size: 14px;
            color: var(--color-text-primary);
            background-color: var(--color-surface);
            transition: all 0.2s ease-in-out;
        }
        .token-input::placeholder {
            color: var(--color-text-muted);
        }
        .token-input:focus {
            border-color: var(--color-brand-blue);
            box-shadow: 0 0 0 3px rgba(2, 134, 195, 0.2);
            outline: none;
        }
        .token-btn-primary {
            background-color: var(--color-brand-blue);
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            min-height: 44px;
            min-width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.2s ease-in-out;
        }
        .token-btn-primary:hover {
            background-color: var(--color-brand-blue-dark);
        }
        .token-btn-secondary {
            background-color: var(--color-surface);
            border: 1px solid var(--color-border-core);
            color: var(--color-text-primary);
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            min-height: 44px;
            min-width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.2s ease-in-out;
        }
        .token-btn-secondary:hover {
            background-color: var(--color-bg-app);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-text-primary font-sans antialiased bg-bg-app">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
        
        <!-- SIDEBAR CONTAINER (#1B1E28 dark, 240px wide) -->
        <!-- Mobile/Tablet Responsive Drawer classes -->
        <aside class="fixed inset-y-0 left-0 z-40 bg-[#1B1E28] text-white transition-all duration-300 flex flex-col"
               :class="{'w-60': !sidebarCollapsed, 'w-16': sidebarCollapsed, '-translate-x-full md:translate-x-0': !sidebarOpen, 'translate-x-0': sidebarOpen}">
            
            <!-- Sidebar Header / Logo -->
            <div class="h-14 flex items-center px-4 border-b border-white/10" :class="{'justify-between': !sidebarCollapsed, 'justify-center': sidebarCollapsed}">
                <div class="flex items-center space-x-3" x-show="!sidebarCollapsed">
                    <div class="w-8 h-8 rounded bg-brand-blue flex items-center justify-center p-1.5 shadow">
                        <svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-base tracking-wide text-white">SIAKAD</span>
                </div>
                <div class="w-8 h-8 rounded bg-brand-blue flex items-center justify-center p-1.5 shadow" x-show="sidebarCollapsed">
                    <svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    </svg>
                </div>
                <!-- Collapse Button for desktop/tablet -->
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden md:block text-white/60 hover:text-white p-1" x-show="!sidebarCollapsed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden md:block text-white/60 hover:text-white p-1" x-show="sidebarCollapsed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="flex-grow py-4 px-2 space-y-1">
                <!-- Dashboard Link -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium transition-all duration-150 {{ Route::is('dashboard') ? 'bg-white/10 text-white border-l-4 border-brand-blue' : 'text-white/70 hover:bg-white/5 hover:text-white' }}"
                   :class="{'justify-start': !sidebarCollapsed, 'justify-center': sidebarCollapsed}"
                   title="Dashboard">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed">Dashboard</span>
                </a>

                <!-- Mahasiswa Link -->
                <a href="{{ route('mahasiswa.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium transition-all duration-150 {{ Route::is('mahasiswa.*') ? 'bg-white/10 text-white border-l-4 border-brand-blue' : 'text-white/70 hover:bg-white/5 hover:text-white' }}"
                   :class="{'justify-start': !sidebarCollapsed, 'justify-center': sidebarCollapsed}"
                   title="Data Mahasiswa">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed">Data Mahasiswa</span>
                </a>
            </nav>

            <!-- Sidebar Footer Status -->
            <div class="p-4 border-t border-white/10 text-xs text-white/50" x-show="!sidebarCollapsed">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-brand-teal"></span>
                    Sistem Aktif
                </span>
            </div>
        </aside>

        <!-- Main Body Wrapper (Shifted right by sidebar size) -->
        <div class="flex-grow flex flex-col transition-all duration-300 min-w-0"
             :class="{'md:pl-60': !sidebarCollapsed, 'md:pl-16': sidebarCollapsed}">
            
            <!-- TOP BAR (56px height, white background, bottom border) -->
            <header class="h-14 bg-white border-b border-border-subtle sticky top-0 z-30 px-4 md:px-8 flex items-center justify-between">
                <!-- Left Section: Mobile Menu Toggle / Collapse toggle -->
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-text-primary p-1.5 rounded hover:bg-bg-app min-h-[44px] min-w-[44px] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <!-- Display Page Title -->
                    <span class="text-sm font-semibold tracking-wide text-text-primary">
                        @yield('page_title', 'SIAKAD Platform')
                    </span>
                </div>

                <!-- Right Section: Status Indicator / Profile info -->
                <div class="flex items-center space-x-4 text-xs font-semibold text-text-secondary">
                    <span class="hidden sm:inline-block px-2.5 py-1 rounded bg-bg-app border border-border-core text-[10px] uppercase tracking-wider text-text-secondary">
                        MySQL XAMPP
                    </span>
                    <span class="px-2.5 py-1 rounded bg-brand-blue/10 border border-brand-blue/20 text-[10px] uppercase tracking-wider text-brand-blue">
                        Lokal v11.0
                    </span>
                </div>
            </header>

            <!-- Page Content (Fluid container, max width 1280px, responsive padding) -->
            <main class="flex-grow p-4 md:p-8 max-w-[1280px] w-full mx-auto space-y-6">
                @yield('content')
            </main>

            <!-- Page Footer -->
            <footer class="bg-white border-t border-border-subtle py-4 px-4 md:px-8 text-center text-xs text-text-secondary">
                <div class="max-w-[1280px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                    <p>&copy; 2026 Contentful Design Platform. Hak Cipta Dilindungi.</p>
                    <p class="text-[10px] text-text-muted">Avenir Next typography system</p>
                </div>
            </footer>
        </div>

        <!-- Mobile Sidebar Backdrop overlay -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 bg-black/40 z-35 md:hidden"
             style="display: none;"
             x-transition:enter="transition-opacity ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>
    </div>

    <!-- Include Centralized Reusable Modal Component -->
    @include('layouts.modal')

</body>
</html>
