<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>

      <!-- Guna Bootstrap melalui link sahaja -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </head>

  <script>
    
    (() => {
      'use strict'
    
      const getStoredTheme = () => localStorage.getItem('theme')
      const setStoredTheme = theme => localStorage.setItem('theme', theme)
    
      const getPreferredTheme = () => {
        const storedTheme = getStoredTheme()
        if (storedTheme) {
          return storedTheme
        }
    
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
      }
    
      const setTheme = theme => {
        if (theme === 'auto') {
          const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches  
          document.documentElement.setAttribute('data-bs-theme', isSystemDark ? 'dark' : 'light')
        } else {
          document.documentElement.setAttribute('data-bs-theme', theme)
        }
      }
    
      setTheme(getPreferredTheme())
    
      const showActiveTheme = (theme, focus = false) => {
        const themeSwitcher = document.querySelector('#bd-theme')
    
        if (!themeSwitcher) {
          return
        }
    
        const themeSwitcherText = document.querySelector('#bd-theme-text')
        const activeThemeIcon = document.querySelector('.theme-icon-active use')
        const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
        
        if (!btnToActive) return  
        const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')
    
        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
          element.classList.remove('active')
          element.setAttribute('aria-pressed', 'false')
        })
    
        btnToActive.classList.add('active')
        btnToActive.setAttribute('aria-pressed', 'true')
        activeThemeIcon.setAttribute('href', svgOfActiveBtn)
        const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
        themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)
    
        if (focus) {
          themeSwitcher.focus()
        }
      }
    
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const storedTheme = getStoredTheme()
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
          setTheme(getPreferredTheme())
          showActiveTheme('auto')
        }
      })
    
      window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme())
    
        document.querySelectorAll('[data-bs-theme-value]')
          .forEach(toggle => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value')
              setStoredTheme(theme)
              setTheme(theme)
              showActiveTheme(theme, true)
            })
          })
      })
    })()
  </script>

  <body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-custom">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Aplikasi</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="mainNavbar">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('senaraiBuku') }}">Home</a>
            </li>
            
            @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @endauth

            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endguest

            <!-- Theme Mode Toggle -->
            <!-- imej mode -->
            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
              <symbol id="circle-half" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
              </symbol>
              <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.099z"/>
              </symbol>
              <symbol id="sun-fill" viewBox="0 0 16 16">
                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
              </symbol>
            </svg>

            <li class="nav-item dropdown">
              <button class="btn btn-link nav-link dropdown-toggle d-flex align-items-center"
                      id="bd-theme"
                      type="button"
                      aria-expanded="false"
                      data-bs-toggle="dropdown"
                      aria-label="Toggle theme (auto)">
                <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
                <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                    Light
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                    Dark
                  </button>
                </li>
              </ul>
            </li>
          </ul>

          <form id="searchForm" class="d-flex ms-auto" role="search" action="{{ route('senaraiBuku') }}" method="GET">
            <select id="categorySelect" name="category" class="form-select me-2" style="width: auto;">
              <option selected disabled hidden>Category</option>
              <option value="title" {{ request('category') == 'title' ? 'selected' : '' }}>Title</option>
              <option value="author" {{ request('category') == 'author' ? 'selected' : '' }}>Author</option>
            </select>
            <input id="searchInput" class="form-control me-2" type="search" name="search" placeholder="Search Book..." aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="container mt-4">
        <div class="" role="">  
        @yield('content')
        </div>
        <footer class="text-center mt-4">
            <p>&copy; 2024. All rights reserved.</p>
        </footer>
    </div>
  </body>

  <style>
    html, body {
    max-width: 100%;
    position: relative;
    }
    
    .navbar-custom {
      /* background-color: rgba(87, 242, 110, 0.8) !important;  */
      background: linear-gradient(90deg, rgba(87, 199, 133, 0.7) 44%, rgba(94, 235, 91, 0.7) 88%) !important;
      
      backdrop-filter: blur(5px);
      /* -webkit-backdrop-filter: blur(10px);  */
      
      border-bottom: 2px solid rgba(255, 255, 255, 0.2)
    }

    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link,
    .navbar-custom .btn-link,
    .navbar-custom #bd-theme-text {
      color: #080808 !important; 
      transition: color 0.3s ease;
    }
  
    [data-bs-theme='dark'] .navbar-custom .nav-link,
    [data-bs-theme='dark'] .navbar-custom .navbar-brand {
      color: #e6e8eb !important; 
    }

    .dropdown-menu .dropdown-item.active, 
    .dropdown-menu .dropdown-item:active {
      background: linear-gradient(90deg, rgba(87, 199, 133, 1) 0%, rgba(94, 235, 91, 1) 100%) !important;
      color: #000 !important; 
    }

    [data-bs-theme='dark'] .dropdown-menu .dropdown-item.active {
      color: #fff !important; 
    }

    .dropdown-item:hover {
      background-color: rgba(87, 199, 133, 0.2) !important;
    }    

    [data-bs-theme='light'] .theme-icon-active {
    fill: #000; 
    }

    [data-bs-theme='dark'] .theme-icon-active {
        fill: #fff; 
    }
  </style>

  <script>
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    const baseUrl = "{{ route('senaraiBuku') }}";

    //Reset URL
    function resetSearch() {
        if (searchInput.value === "") {
            window.location.href = baseUrl;
        }
    }

    //Click x
    searchInput.addEventListener('search', resetSearch);

    //Remove search
    searchInput.addEventListener('keyup', function() {
        if (this.value === "") {
            window.location.href = baseUrl;
        }
    });
  </script>
</html>