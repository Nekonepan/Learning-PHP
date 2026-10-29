.DEFAULT_GOAL := help

PHP ?= php
HOST ?= 127.0.0.1
PORT ?= 8000

.PHONY: help install-deps run check

help:
	@echo "Targets:"
	@echo "  make install-deps  Install PHP CLI on Debian/Ubuntu"
	@echo "  make check         Check PHP syntax in all project files"
	@echo "  make run           Start the app at http://$(HOST):$(PORT)"
	@echo ""
	@echo "Override server settings with: make run HOST=0.0.0.0 PORT=8080"

install-deps:
	sudo apt-get update
	sudo apt-get install -y php-cli

check:
	@command -v "$(PHP)" >/dev/null 2>&1 || { echo "PHP CLI is missing. Run 'make install-deps' (Debian/Ubuntu) or install PHP CLI for your OS."; exit 1; }
	@set -e; for file in *.php; do "$(PHP)" -l "$$file"; done

run:
	@command -v "$(PHP)" >/dev/null 2>&1 || { echo "PHP CLI is missing. Run 'make install-deps' (Debian/Ubuntu) or install PHP CLI for your OS."; exit 1; }
	$(PHP) -S $(HOST):$(PORT) -t .
