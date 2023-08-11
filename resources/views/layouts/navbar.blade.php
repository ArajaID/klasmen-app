<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active text-success fw-bold text-decoration-underline' : '' }}"
                        href="/">Daftar Klasmen</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('club*') ? 'active text-success fw-bold text-decoration-underline' : '' }}"
                        href="/club">Klub Sepak Bola</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('score*') ? 'active text-success fw-bold text-decoration-underline' : '' }}"
                        href="/score">Skor</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
