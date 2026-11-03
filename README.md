# Benign PoC — does a repository's code run during a scan?

Harmless proof-of-concept. All manifests/configs live in the REPO ROOT, because
the scanner runs its tools from the clone root and only looks for build files,
requirements and tool configs there. Each vector writes a marker to /tmp. The
markers are benign: only a timestamp and the vector name. If a scanner is
hardened, the marker does NOT appear.

## Check after a scan
    docker compose exec <service> sh -c 'ls -la /tmp/scan-probe-*.txt; cat /tmp/scan-probe-*.txt'

## Vectors (select the matching project type when scanning)
- A  java   — ./gradlew is run from the repo        -> /tmp/scan-probe-gradlew.txt
- B  java   — Groovy in build.gradle (system gradle) -> /tmp/scan-probe-buildgradle.txt
- C  php    — vendor/autoload.php via PHPStan/Psalm   -> /tmp/scan-probe-php-autoload.txt
- D  php    — hang (holds a scan slot)                -> sleeping process
- E  python — repo hides django vulns via configs     -> findings should NOT drop

Notes:
- A vs B: the Java build prefers an executable ./gradlew, so a Java scan fires A.
  To test B instead, remove gradlew/gradlew.bat so the system `gradle` parses
  build.gradle.
- D is OFF by default. Uncomment the `sleep` line in vendor/autoload.php to arm
  it, then run a PHP scan. A hardened scanner ends it on timeout and frees the slot.
