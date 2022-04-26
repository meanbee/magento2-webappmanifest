# Meanbee_WebAppManifest

A Magento 2 extension that adds a [Web App Manifest](https://developer.mozilla.org/en-US/docs/Web/Manifest) to the store.

## Installation

Install this extension via Composer:

    composer require meanbee/magento2-webappmanifest

## Usage

Configure the information displayed in the manifest and enable it in * Stores > Configuration > General > Web > Web App Manifest Settings *.

## Development

### Setting up a development environment

A Docker development environment is included with the project:

    docker-compose run --rm cli magento-extension-installer Meanbee_WebAppManifest \
    && docker-compose up -d
