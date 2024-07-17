# Laravel Telegram Message Forwarder

This Laravel application is designed to forward messages from one Telegram channel to another. By setting up a few configuration parameters, you can easily duplicate messages from a source channel to a destination chat using your own Telegram bot.

## Requirements

- PHP 8.3 or higher
- Composer
- Laravel 11.x or higher
- A Telegram bot and API credentials

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/yourusername/laravel-telegram-message-forwarder.git
    cd laravel-telegram-message-forwarder
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Copy the `.env.example` file to `.env` and fill in the necessary details:**

    ```sh
    cp .env.example .env
    ```

## Configuration

Open the `.env` file and fill in the following variables with your own Telegram API credentials and channel IDs:

```env
# Telegram API credentials
TELEGRAM_API_ID=
TELEGRAM_API_HASH=

# Telegram bot token
TELEGRAM_BOT_TOKEN=

# Your personal ID (the account where messages are duplicated)
TELEGRAM_DESTINATION_CHAT_ID=

# The source channel ID (the channel from where messages are copied)
TELEGRAM_SOURCE_CHANNEL_ID=
```

## Usage

To start the message forwarding script, run the following Artisan command:

```sh
php artisan telegram:client
```
This will start the process of duplicating messages from the source channel to the destination chat.

## Artisan Commands

- `telegram:client` - Starts the Telegram client to forward messages.

## Troubleshooting

If you encounter any issues, ensure that:

- All environment variables in the `.env` file are correctly set.
- Your Telegram bot has the necessary permissions to read messages from the source channel and send messages to the destination chat.
- The Laravel application has access to the internet and can reach the Telegram API.

## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request. We welcome all contributions that improve the functionality or documentation of this project.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

If you have any questions or need further assistance, please contact @dij09901 on Telegram.
