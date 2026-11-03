# Benign PoC — does a repository's code run during a scan?

A harmless proof-of-concept. Each vector, when executed by a build/dependency
scanner, writes a marker file to /tmp. The markers are benign: only a timestamp
and the vector name, no reading of secrets and nothing destructive. If a scanner
is hardened, the corresponding marker does NOT appear.

## How to check after a scan
    docker compose exec <service> sh -c 'ls -la /tmp/scan-probe-*.txt; cat /tmp/scan-probe-*.txt'

## Vectors
- A  gradlew       — ./gradlew is run from the repo            -> /tmp/scan-probe-gradlew.txt
- B  build.gradle  — Groovy code in build.gradle (system gradle)-> /tmp/scan-probe-buildgradle.txt
- C  php-autoload  — vendor/autoload.php, loaded by PHPStan      -> /tmp/scan-probe-php-autoload.txt
- D  hang          — a stuck scan (holds a slot)                 -> a sleeping process
- E  trivy/grype   — the repo hides its own vulnerabilities      -> findings disappear

Vector D is DISABLED by default (see hang/README). Enable it separately so it
does not block the other vectors during a check.
