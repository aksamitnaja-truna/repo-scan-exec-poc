# Vector D — stuck scan (DISABLED by default)

This vector holds a scan slot forever. To avoid blocking the other vectors, the
autoloader here is benign by default.

To enable the hang, uncomment the `sleep` line in vendor/autoload.php, commit,
run a scan, and watch the phpstan/psalm step hang:

    docker compose exec <service> sh -c 'ps aux | grep -E "php|psalm|phpstan"'

A hardened scanner (shared runner with a timeout) should end the scan on timeout
and free the slot.
