# Vector E — the repo hides its own vulnerabilities

1. First rename/remove .trivyignore, trivy.yaml, .grype.yaml, commit, and scan.
   Note the number of findings for django.
2. Put the config files back, commit, and scan again.
   A hardened scanner (passing its own --config/--ignorefile and not reading from
   the repo) should report the SAME number of findings.
