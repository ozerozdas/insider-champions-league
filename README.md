# Insider Champions League

This is a Laravel project for Insider Champions League. You can change result strategy in `.env` file.

![Test Status](https://github.com/ozerozdas/insider-champions-league/actions/workflows/testing.yml/badge.svg?branch=main)

- [Installation](#installation)
- [License](#license)
- [Author](#author)

## Installation

```bash
git clone https://github.com/ozerozdas/insider-champions-league.git
cd insider-champions-league
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
npm install
npm run build
```

## License

MIT

## Author

Mehmet Özer Özdaş

[https://github.com/ozerozdas](https://github.com/ozerozdas)