<footer class="sticky-footer bg-white dark:bg-gray-900 text-white shadow-lg mt-auto">
        <div class="copyright text-center my-auto py-4">
            <span class="text-sm text-gray-400">
                Copyright &copy; Ngadem {{ date('Y') }}
                <br class="d-md-none">
                Dibuat oleh Tim Ngadem
            </span>
        </div>
    </div>
</footer>

<style>
    .sticky-footer {
        flex-shrink: 0;
        padding: 1.5rem 0;
    }

    @media (max-width: 767.98px) {
        .sticky-footer .copyright {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
