<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#e0f2fe',
                            100: '#bae6fd',
                            200: '#7dd3fc',
                            300: '#38bdf8',
                            400: '#0ea5e9',
                            500: '#0284c7',
                            600: '#0369a1',
                            700: '#075985',
                            800: '#0c4a6e',
                            900: '#082f49',
                            950: '#051e2f',
                        },
                        dark: {
                            50: '#f1f5f9',
                            100: '#e2e8f0',
                            200: '#cbd5e1',
                            300: '#94a3b8',
                            400: '#64748b',
                            500: '#475569',
                            600: '#334155',
                            700: '#1e293b',
                            800: '#0f172a',
                            900: '#020617',
                            950: '#010312',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0.4); }
            70% { box-shadow: 0 0 0 8px rgba(2, 132, 199, 0); }
            100% { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0); }
        }
        
        @keyframes shimmer {
            0% { background-position: -100% 0; }
            100% { background-position: 200% 0; }
        }
        
        @keyframes floatUp {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        .animate-pulse-glow {
            animation: pulseGlow 2s infinite;
        }
        
        .animate-float {
            animation: floatUp 3s ease-in-out infinite;
        }
        
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        .dark body {
            background-color: #0f172a;
        }
        
        body {
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(220, 220, 220, 0.3);
        }
        
        .btn-hover-effect {
            position: relative;
            overflow: hidden;
        }
        
        .btn-hover-effect:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }
        
        .btn-hover-effect:hover:after {
            width: 200%;
            height: 200%;
        }
        
        input:focus {
            transition: all 0.3s ease;
            transform: scale(1.01);
        }
        
        /* Theme transition */
        .theme-transition {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
</head>
<body class="theme-transition dark:bg-gradient-to-br dark:from-dark-800 dark:to-dark-950 bg-gradient-to-br from-blue-50 to-slate-100 min-h-screen p-6">

<nav class="fixed top-0 left-0 right-0 z-50 theme-transition dark:bg-dark-900/90 bg-white/90 backdrop-blur-md shadow-md py-4 px-6 dark:border-b dark:border-primary-900/50 border-b border-slate-200">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-2 animate-float">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 theme-transition dark:text-primary-400 text-primary-600" viewBox="0 0 20 20" fill="currentColor">
                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
            </svg>
            <span class="font-bold text-xl theme-transition dark:text-white text-dark-800">Dashboard</span>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="flex items-center justify-center h-10 w-10 rounded-full theme-transition dark:bg-dark-700 bg-slate-200 shadow-sm hover:shadow-md">
                <!-- Sun icon (shown in dark mode) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 dark:block hidden theme-transition dark:text-yellow-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                </svg>
                <!-- Moon icon (shown in light mode) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 dark:hidden block theme-transition text-dark-700" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>
            
            <div class="mr-4 flex items-center">
                <span class="h-8 w-8 rounded-full theme-transition dark:bg-primary-700 bg-primary-100 flex items-center justify-center mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 theme-transition dark:text-white text-primary-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="theme-transition dark:text-white text-dark-700 font-medium">
                    @if(isset(session('fullResponse')['userInfo']['username']))
                        {{ session('fullResponse')['userInfo']['username'] }}
                    @else
                        User
                    @endif
                </span>
            </div>

            <form method="POST" action="/logout" id="logout-form">
                @csrf
                <button type="submit" class="h-10 w-10 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/50 transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                        <line x1="12" y1="2" x2="12" y2="12"></line>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="max-w-4xl mx-auto relative pt-24">
    @if(session('success'))
        <div class="theme-transition dark:bg-green-900/50 bg-green-100 dark:border dark:border-green-500 border border-green-300 dark:text-green-300 text-green-800 px-4 py-3 rounded-lg mb-4 shadow-sm animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="theme-transition dark:bg-red-900/50 bg-red-100 dark:border dark:border-red-500 border border-red-300 dark:text-red-300 text-red-800 px-4 py-3 rounded-lg mb-4 shadow-sm animate-fade-in">
            {{ session('error') }}
        </div>
    @endif

    <div class="glass-card rounded-xl shadow-md dark:border-primary-800/50 border-blue-200/50 p-8 mb-6 animate-fade-in">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold theme-transition dark:text-white text-dark-800">Item Search</h2>
            <button id="sample-query" class="theme-transition dark:bg-primary-900/80 bg-primary-100 dark:text-primary-200 text-primary-700 px-4 py-2 rounded-lg dark:hover:bg-primary-800 hover:bg-primary-200 transition-all duration-300 flex items-center gap-2 dark:border dark:border-primary-700 border border-primary-300 transform hover:scale-105 hover:shadow-md dark:hover:shadow-primary-900/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                Sample
            </button>
        </div>
        
        <div class="space-y-6">
            <div class="flex space-x-4 items-center">
                <!-- Filter Dropdown -->
                <div class="relative w-1/3">
                    <label for="filter" class="block text-sm font-medium theme-transition dark:text-gray-300 text-gray-700 mb-1">Search by:</label>
                    <select id="filter" class="theme-transition w-full px-4 py-4 dark:border-dark-600 border-slate-300 rounded-xl dark:bg-dark-800/80 bg-white/80 backdrop-blur-sm dark:text-white text-dark-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 shadow-sm transition-all">
                        <option value="LITM">2nd Item Number</option>
                        <option value="ITM">Short Item Number</option>
                    </select>
                </div>

                <!-- Search Mode Toggle -->
                <div class="relative w-2/3">
                    <label class="block text-sm font-medium theme-transition dark:text-gray-300 text-gray-700 mb-1">Search Mode:</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="any-mode" name="search-mode" value="any" checked 
                                class="appearance-none w-4 h-4 rounded-full border-2 border-primary-600 checked:bg-primary-600 checked:border-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600/50 transition-all cursor-pointer">
                            <label for="any-mode" class="ml-2 cursor-pointer flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 theme-transition dark:text-gray-300 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="theme-transition dark:text-gray-300 text-gray-700">Match Any (OR)</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="all-mode" name="search-mode" value="all"
                                class="appearance-none w-4 h-4 rounded-full border-2 border-primary-600 checked:bg-primary-600 checked:border-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600/50 transition-all cursor-pointer">
                            <label for="all-mode" class="ml-2 cursor-pointer flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 theme-transition dark:text-gray-300 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h4a1 1 0 110 2H4a1 1 0 01-1-1zm8 0a1 1 0 011-1h4a1 1 0 110 2h-4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="theme-transition dark:text-gray-300 text-gray-700">Match All (AND)</span>
                            </label>
                        </div>
                    </div>

                    </div>
                </div>
            </div>

            <div class="flex space-x-4 items-center mt-4">
                <!-- Item Search Input -->
                <div class="relative w-1/2">
                    <label for="search-input" class="block text-sm font-medium theme-transition dark:text-gray-300 text-gray-700 mb-1">2nd/Short Item number:</label>
                    <div class="relative">
                        <input type="text" id="search-input" class="theme-transition w-full px-4 py-4 pl-12 dark:border-dark-600 border-slate-300 rounded-xl dark:bg-dark-800/80 bg-white/80 backdrop-blur-sm dark:text-white text-dark-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 shadow-sm transition-all" placeholder="Enter item number...">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 theme-transition dark:text-dark-400 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- 3rd Item Number Search Input -->
                <div class="relative w-1/2">
                    <label for="third-item-input" class="block text-sm font-medium theme-transition dark:text-gray-300 text-gray-700 mb-1">3rd Item Number:</label>
                    <div class="relative">
                        <input type="text" id="third-item-input" class="theme-transition w-full px-4 py-4 pl-12 dark:border-dark-600 border-slate-300 rounded-xl dark:bg-dark-800/80 bg-white/80 backdrop-blur-sm dark:text-white text-dark-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 shadow-sm transition-all" placeholder="Search by 3rd item number...">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 theme-transition dark:text-dark-400 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Search Input -->
            <div class="relative w-full mt-4">
                <label for="description-input" class="block text-sm font-medium theme-transition dark:text-gray-300 text-gray-700 mb-1">Description:</label>
                <div class="relative">
                    <input type="text" id="description-input" class="theme-transition w-full px-4 py-4 pl-12 dark:border-dark-600 border-slate-300 rounded-xl dark:bg-dark-800/80 bg-white/80 backdrop-blur-sm dark:text-white text-dark-800 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 shadow-sm transition-all" placeholder="Search in description...">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 theme-transition dark:text-dark-400 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <button id="submit-search" class="w-full bg-gradient-to-r from-primary-600 to-primary-500 text-white py-4 rounded-xl hover:from-primary-500 hover:to-primary-400 transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg hover:shadow-primary-900/50 font-medium btn-hover-effect animate-pulse-glow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                Search
            </button>
        </div>
    </div>

    @if(session('query_result'))
    <div class="glass-card rounded-xl shadow-md dark:border-primary-800/50 border-blue-200/50 p-8 mb-6 animate-fade-in">
        <h2 class="text-xl font-bold theme-transition dark:text-white text-dark-800 mb-4">Query Results</h2>
        
        @php
            $result = session('query_result');
            $hasGridData = false;
            $gridData = null;
                
            // Check if this is a grid data result
            foreach ($result as $key => $value) {
                if (isset($value['data']) && isset($value['data']['gridData'])) {
                    $hasGridData = true;
                    $gridData = $value['data']['gridData'];
                    $title = $value['title'] ?? 'Query Results';
                    break;
                }
            }
        @endphp
        
        @if($hasGridData && $gridData && isset($gridData['columnInfo']))
            <div class="mb-6">
                <h3 class="text-lg font-semibold theme-transition dark:text-white text-dark-800">{{ $title }}</h3>
                <p class="text-sm theme-transition dark:text-primary-400 text-primary-600">Found {{ count($gridData['rowset'] ?? []) }} records</p>
            </div>
            
            @if(isset($gridData['rowset']) && count($gridData['rowset']) > 0)
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full border-collapse border-spacing-0 overflow-hidden theme-transition dark:bg-dark-700/80 bg-white/80 backdrop-blur-sm dark:border-dark-600/30 border-slate-200/50 shadow-md">
                        <thead>
                            <tr class="theme-transition dark:bg-primary-900/80 bg-primary-600/90">
                                @foreach($gridData['columnInfo'] as $colId => $column)
                                    @if($column['visible'])
                                        <th class="text-left py-3 px-4 theme-transition dark:text-primary-100 text-white font-medium text-xs uppercase tracking-wider dark:border-b dark:border-r dark:border-dark-600/30 border-b border-r border-primary-500/50 last:border-r-0">
                                            {{ $column['title'] }}
                                        </th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="table-body" class="theme-transition dark:divide-y dark:divide-dark-600/30 divide-y divide-slate-100">
                            <!-- Table rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Controls -->
                <div id="pagination-controls" class="flex flex-col sm:flex-row items-center justify-between mt-4 theme-transition gap-4">
                    <div class="flex items-center">
                        <span class="text-sm theme-transition dark:text-gray-300 text-gray-700">
                            Showing <span id="showing-start">0</span> to <span id="showing-end">0</span> of <span id="total-items">0</span> results
                        </span>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center">
                            <button id="first-page" class="theme-transition dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 px-2 py-1 rounded-lg disabled:opacity-50 dark:hover:bg-dark-600 hover:bg-gray-100 dark:border dark:border-dark-600 border border-slate-300 transition-all" title="First page">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                </svg>
                            </button>
                            <button id="prev-page" class="theme-transition dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 px-3 py-1 rounded-lg disabled:opacity-50 dark:hover:bg-dark-600 hover:bg-gray-100 dark:border dark:border-dark-600 border border-slate-300 transition-all ml-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <div id="page-numbers" class="flex items-center space-x-1 mx-1"></div>
                            <button id="next-page" class="theme-transition dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 px-3 py-1 rounded-lg disabled:opacity-50 dark:hover:bg-dark-600 hover:bg-gray-100 dark:border dark:border-dark-600 border border-slate-300 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button id="last-page" class="theme-transition dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 px-2 py-1 rounded-lg disabled:opacity-50 dark:hover:bg-dark-600 hover:bg-gray-100 dark:border dark:border-dark-600 border border-slate-300 transition-all ml-1" title="Last page">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7m-8-14l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center space-x-2">
                            <label for="items-per-page" class="text-sm theme-transition dark:text-gray-300 text-gray-700">
                                Per page:
                            </label>
                            <select id="items-per-page" class="theme-transition text-sm dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 border dark:border-dark-600 border-slate-300 rounded px-2 py-1">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <span class="text-sm theme-transition dark:text-gray-300 text-gray-700">Go to:</span>
                            <input type="number" id="page-jump" min="1" class="w-16 theme-transition text-sm dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 border dark:border-dark-600 border-slate-300 rounded px-2 py-1" value="1">
                            <button id="page-jump-btn" class="theme-transition dark:bg-primary-700 bg-primary-600 text-white px-2 py-1 rounded hover:bg-primary-500 dark:hover:bg-primary-600 transition-all text-sm">Go</button>
                        </div>
                    </div>
                </div>
                
                <script>
                    // Store the grid data in a JavaScript variable
                    const gridData = @json($gridData);
                    
                    // Pagination settings
                    const paginationState = {
                        currentPage: 1,
                        itemsPerPage: 10,
                        totalPages: 0
                    };
                    
                    // Render table rows with pagination
                    function renderTableRows() {
                        const tableBody = document.getElementById('table-body');
                        tableBody.innerHTML = '';
                        
                        if (!gridData.rowset || !gridData.rowset.length) {
                            return;
                        }
                        
                        // Calculate pagination
                        paginationState.totalPages = Math.ceil(gridData.rowset.length / paginationState.itemsPerPage);
                        const startIndex = (paginationState.currentPage - 1) * paginationState.itemsPerPage;
                        const endIndex = Math.min(startIndex + paginationState.itemsPerPage, gridData.rowset.length);
                        const currentPageRows = gridData.rowset.slice(startIndex, endIndex);
                        
                        // Update showing text
                        document.getElementById('showing-start').textContent = gridData.rowset.length > 0 ? startIndex + 1 : 0;
                        document.getElementById('showing-end').textContent = endIndex;
                        document.getElementById('total-items').textContent = gridData.rowset.length;
                        
                        // Render the current page rows
                        currentPageRows.forEach((row, index) => {
                            const tr = document.createElement('tr');
                            
                            // Apply different classes based on theme
                            if (document.documentElement.classList.contains('dark')) {
                                tr.className = index % 2 === 0 ? 'bg-dark-800/80' : 'bg-dark-700/90';
                                tr.classList.add('hover:bg-primary-800/50', 'transition-all', 'duration-150', 'theme-transition');
                            } else {
                                tr.className = index % 2 === 0 ? 'bg-white' : 'bg-slate-100';
                                tr.classList.add('hover:bg-primary-50/70', 'transition-all', 'duration-150', 'theme-transition');
                            }
                            
                            // Add animation delay based on row index
                            tr.style.animation = `fadeIn 0.3s ease-out ${index * 0.05}s both`;
                            tr.style.opacity = '0'; // Start invisible for animation
                            
                            for (const [colId, column] of Object.entries(gridData.columnInfo)) {
                                if (column.visible) {
                                    const td = document.createElement('td');
                                    if (document.documentElement.classList.contains('dark')) {
                                        td.className = 'py-3 px-4 text-sm text-gray-300 border-r border-dark-600/30 last:border-r-0 theme-transition';
                                    } else {
                                        td.className = 'py-3 px-4 text-sm text-gray-700 border-r border-slate-200 last:border-r-0 theme-transition';
                                    }
                                    td.textContent = row[colId]?.value || '';
                                    tr.appendChild(td);
                                }
                            }
                            
                            tableBody.appendChild(tr);
                        });
                        
                        // Update pagination controls
                        updatePaginationControls();
                    }
                    
                    // Update pagination controls
                    function updatePaginationControls() {
                        const prevBtn = document.getElementById('prev-page');
                        const nextBtn = document.getElementById('next-page');
                        const firstBtn = document.getElementById('first-page');
                        const lastBtn = document.getElementById('last-page');
                        const pageNumbers = document.getElementById('page-numbers');
                        const pageJumpInput = document.getElementById('page-jump');
                        
                        // Enable/disable navigation buttons
                        firstBtn.disabled = prevBtn.disabled = paginationState.currentPage === 1;
                        lastBtn.disabled = nextBtn.disabled = paginationState.currentPage === paginationState.totalPages;
                        
                        // Update page jump input
                        pageJumpInput.max = paginationState.totalPages;
                        pageJumpInput.value = paginationState.currentPage;
                        
                        // Clear existing page numbers
                        pageNumbers.innerHTML = '';
                        
                        // Determine which page numbers to show
                        let startPage, endPage;
                        if (paginationState.totalPages <= 5) {
                            // Show all pages if 5 or fewer
                            startPage = 1;
                            endPage = paginationState.totalPages;
                        } else {
                            // Show at most 5 pages with current page in the middle if possible
                            if (paginationState.currentPage <= 3) {
                                startPage = 1;
                                endPage = 5;
                            } else if (paginationState.currentPage >= paginationState.totalPages - 2) {
                                startPage = paginationState.totalPages - 4;
                                endPage = paginationState.totalPages;
                            } else {
                                startPage = paginationState.currentPage - 2;
                                endPage = paginationState.currentPage + 2;
                            }
                        }
                        
                        // Add page number buttons
                        for (let i = startPage; i <= endPage; i++) {
                            const pageBtn = document.createElement('button');
                            pageBtn.textContent = i;
                            pageBtn.className = `theme-transition w-8 h-8 flex items-center justify-center rounded-md text-sm ${
                                i === paginationState.currentPage 
                                    ? 'dark:bg-primary-700 bg-primary-600 text-white' 
                                    : 'dark:bg-dark-700 bg-white dark:text-gray-300 text-gray-700 dark:border dark:border-dark-600 border border-slate-300 dark:hover:bg-dark-600 hover:bg-gray-100'
                            }`;
                            pageBtn.addEventListener('click', () => goToPage(i));
                            pageNumbers.appendChild(pageBtn);
                        }
                    }
                    
                    // Change page
                    function goToPage(pageNumber) {
                        if (pageNumber < 1 || pageNumber > paginationState.totalPages) {
                            return;
                        }
                        
                        paginationState.currentPage = pageNumber;
                        renderTableRows();
                        
                        // Scroll to top of table for better UX
                        const table = document.querySelector('table');
                        if (table) {
                            table.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    }
                    
                    // Initialize table
                    document.addEventListener('DOMContentLoaded', function() {
                        renderTableRows();
                        
                        // Event listeners for pagination controls
                        document.getElementById('prev-page').addEventListener('click', () => {
                            if (paginationState.currentPage > 1) {
                                goToPage(paginationState.currentPage - 1);
                            }
                        });
                        
                        document.getElementById('next-page').addEventListener('click', () => {
                            if (paginationState.currentPage < paginationState.totalPages) {
                                goToPage(paginationState.currentPage + 1);
                            }
                        });
                        
                        // First page button
                        document.getElementById('first-page').addEventListener('click', () => {
                            if (paginationState.currentPage !== 1) {
                                goToPage(1);
                            }
                        });
                        
                        // Last page button
                        document.getElementById('last-page').addEventListener('click', () => {
                            if (paginationState.currentPage !== paginationState.totalPages) {
                                goToPage(paginationState.totalPages);
                            }
                        });
                        
                        // Page jump functionality
                        document.getElementById('page-jump-btn').addEventListener('click', () => {
                            const pageInput = document.getElementById('page-jump');
                            const page = parseInt(pageInput.value, 10);
                            if (page && page >= 1 && page <= paginationState.totalPages) {
                                goToPage(page);
                            } else {
                                // Reset to valid value if invalid input
                                pageInput.value = paginationState.currentPage;
                            }
                        });
                        
                        // Allow Enter key to trigger page jump
                        document.getElementById('page-jump').addEventListener('keypress', (e) => {
                            if (e.key === 'Enter') {
                                document.getElementById('page-jump-btn').click();
                            }
                        });
                        
                        // Event listener for items per page dropdown
                        document.getElementById('items-per-page').addEventListener('change', function() {
                            paginationState.itemsPerPage = parseInt(this.value, 10);
                            // Reset to first page when changing items per page
                            paginationState.currentPage = 1;
                            renderTableRows();
                        });
                        
                        // Re-render table when theme changes
                        document.getElementById('theme-toggle').addEventListener('click', function() {
                            setTimeout(renderTableRows, 50);
                        });
                    });
                </script>
            @else
                <div class="theme-transition dark:bg-yellow-900/40 bg-yellow-50 backdrop-blur-sm dark:border-yellow-600/50 border-yellow-200 dark:text-yellow-300 text-yellow-800 p-6 rounded-lg shadow-sm">
                    <p>No rows found in the grid data.</p>
                </div>
            @endif
        @else
            <pre class="theme-transition text-sm dark:bg-dark-800/80 bg-slate-50 backdrop-blur-sm dark:border-dark-600/50 border-slate-200 p-6 rounded-lg overflow-x-auto shadow-inner font-mono dark:text-gray-300 text-slate-800">{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
        @endif
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Restore last search values from PHP session if available
        @if(session('last_search'))
            const sessionSearchValues = @json(session('last_search'));
            if (sessionSearchValues) {
                document.getElementById('search-input').value = sessionSearchValues.searchTerm || '';
                document.getElementById('third-item-input').value = sessionSearchValues.thirdItemTerm || '';
                document.getElementById('description-input').value = sessionSearchValues.descriptionTerm || '';
                document.getElementById('filter').value = sessionSearchValues.filter || 'LITM';
                if (sessionSearchValues.searchMode) {
                    const modeInput = document.querySelector(`input[name="search-mode"][value="${sessionSearchValues.searchMode}"]`);
                    if (modeInput) {
                        modeInput.checked = true;
                    }
                }
            }
        @endif

        // Theme toggling functionality
        const themeToggleBtn = document.getElementById('theme-toggle');
        const html = document.documentElement;
        
        // Check for saved theme preference or prefer-color-scheme
        const savedTheme = localStorage.getItem('theme');
        
        if (savedTheme === 'light') {
            html.classList.remove('dark');
        } else if (savedTheme === 'dark') {
            html.classList.add('dark');
        } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Theme toggle button
        themeToggleBtn.addEventListener('click', function() {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

        // Store token in sessionStorage when page loads
        @if(session('token'))
            sessionStorage.setItem('aisAuthToken', @json(session('token')));
        @endif

        // Sample button handler
        document.getElementById('sample-query').addEventListener('click', function() {
            document.getElementById('search-input').value = 'AH10000335';
            document.getElementById('third-item-input').value = '';
            document.getElementById('description-input').value = '';
            document.getElementById('submit-search').click();
        });
        
        // Submit search handler
        document.getElementById('submit-search').addEventListener('click', function() {
            // Show loading state
            this.disabled = true;
            this.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Searching...
            `;
            
            // Get search terms and mode
            const searchTerm = document.getElementById('search-input').value.trim();
            const thirdItemTerm = document.getElementById('third-item-input').value.trim();
            const descriptionTerm = document.getElementById('description-input').value.trim();
            const filter = document.getElementById('filter').value.trim() || 'LITM';
            const searchMode = document.querySelector('input[name="search-mode"]:checked').value;
            
            // Get token from sessionStorage
            const token = sessionStorage.getItem('aisAuthToken');
            if (!token) {
                alert('No authentication token found. Please log in again.');
                resetButton();
                return;
            }
            
            // Build the payload
            const payload = {
                aliasNaming: true,
                dataServiceType: "BROWSE",
                deviceName: "JDE",
                maxPageSize: "1000",
                outputType: "VERSION2",
                query: {
                    autoFind: true,
                    condition: [],
                    matchType: searchMode === 'any' ? 'MATCH_ANY' : 'MATCH_ALL'
                },
                returnControlIDs: "F4101.LITM|F4101.DSC1|F4101.DSC2|F4101.AITM|F4101.ITM",
                targetName: "F4101",
                targetType: "table",
                token: token
            };

            // Create conditions array
            const conditions = [];

            // Add 2nd/Short item number condition if provided
            if (searchTerm) {
                conditions.push({
                    controlId: `F4101.${filter}`,
                    operator: "STR_CONTAIN",
                    value: [{
                        content: searchTerm,
                        specialValueId: "LITERAL"
                    }]
                });
            }

            // Add 3rd item number condition if provided
            if (thirdItemTerm) {
                conditions.push({
                    controlId: "F4101.AITM",
                    operator: "STR_CONTAIN",
                    value: [{
                        content: thirdItemTerm,
                        specialValueId: "LITERAL"
                    }]
                });
            }

            // Add description condition if provided
            if (descriptionTerm) {
                conditions.push({
                    controlId: "F4101.DSC1",
                    operator: "STR_CONTAIN",
                    value: [{
                        content: descriptionTerm,
                        specialValueId: "LITERAL"
                    }]
                });
            }

            // Ensure at least one search term is provided
            if (conditions.length === 0) {
                alert('Please enter at least one search term.');
                resetButton();
                return;
            }

            // Set the conditions in the query
            payload.query.condition = conditions;
            
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/ais/query';
            
            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfInput);
            
            // Add the query
            const queryInput = document.createElement('input');
            queryInput.type = 'hidden';
            queryInput.name = 'query';
            queryInput.value = JSON.stringify(payload);
            form.appendChild(queryInput);
            
            // Add last search values
            const lastSearchInput = document.createElement('input');
            lastSearchInput.type = 'hidden';
            lastSearchInput.name = 'last_search';
            lastSearchInput.value = JSON.stringify({
                searchTerm: searchTerm,
                thirdItemTerm: thirdItemTerm,
                descriptionTerm: descriptionTerm,
                filter: filter,
                searchMode: searchMode
            });
            form.appendChild(lastSearchInput);
            
            // Submit form
            document.body.appendChild(form);
            form.submit();
        });
        
        // Helper function to reset button
        function resetButton() {
            const btn = document.getElementById('submit-search');
            btn.disabled = false;
            btn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                Search
            `;
        }

        // Set initial placeholder text
        document.getElementById('search-input').placeholder = 'Enter 2nd item number...';

        // Update placeholder based on filter selection
        document.getElementById('filter').addEventListener('change', function() {
            const searchInput = document.getElementById('search-input');
            searchInput.placeholder = this.value === 'LITM' ? 'Enter 2nd item number...' : 'Enter short item number...';
        });

        // Set initial state from session if available
        @if(session('last_search') && isset(session('last_search')['searchMode']))
            const savedMode = @json(session('last_search')['searchMode']);
            const radioToCheck = document.querySelector(`input[name="search-mode"][value="${savedMode}"]`);
            if (radioToCheck) {
                radioToCheck.checked = true;
            }
        @endif
    });
</script>

</body>
</html>
