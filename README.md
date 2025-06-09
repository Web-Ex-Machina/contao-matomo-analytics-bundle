# Contao Matomo Analytics Bundle

The Contao Matomo Analytics Bundle integrates Matomo (formerly Piwik) analytics directly into your Contao CMS backend using an external instance.

> [!WARNING]
> This bundle is not compatible with Contao 4

## Features

- **Automatically add the tracking code**: No need to manually add the tracking code to your website.
- **Seamless Matomo Integration**: Connect your Contao website to your Matomo analytics instance
- **Backend Dashboard**: View key analytics metrics directly in your Contao backend
- **Support for Multiple Websites** : Each root page can be associated with a different Matomo instance and/or website.

## Requirements

- PHP 8.2 or higher
- Contao 5.x
- A running Matomo instance with API access
- Matomo API token with sufficient permissions

## Installation

### Via Composer (recommended)

```bash
composer require webexmachina/contao-matomo-analytics
```

### Via Contao Manager

1. Search for "contao matomo analytics" in the Contao Manager
2. Click on "Add"
3. Apply the changes and update the database

### Via ZIP file

1. Download the latest release from the [GitHub repository](https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle)
2. Extract the ZIP file
3. Copy the extracted files to the `vendor/webexmachina/contao-matomo-analytics` directory of your Contao installation
4. Update the composer.json file manually or run the Contao Install Tool

## Configuration

1. Log in to your Contao backend
2. Navigate to a root page in the page structure and click on the pen icon.
3. Configure the Matomo analytics settings for the page:
   - Matomo URL: The URL of your Matomo instance (e.g., https://analytics.example.com)
   - Matomo API Key: Your Matomo API authentication token
4. Save the configuration, after the refresh, the list will propose all the available websites choose one and save. 

## Usage

Once configured, you can access the analytics dashboard for each root page by:

1. Navigating to the page structure in the Contao backend
2. Clicking on the "Analytics" icon next to the page

The dashboard provides:
- Overview of key metrics for the last 30 days
- Detailed breakdown of visitor information
- Device and language statistics
- Conversion and referrer data
- A link to the full Matomo dashboard for more detailed analysis

## GDPR compliance

This bundle is only compatible with Matomo, once set up. It will always activate audience tracking.

The bundle assumes that the Matomo instance is configured to respect the privacy of European users. 
When a Matomo instance is correctly configured, the use of a cookie banner is not an obligation.

[Matomo : Analytics without consent or cookie banner](https://matomo.org/faq/new-to-piwik/how-do-i-use-matomo-analytics-without-consent-or-cookie-banner/)

## Support

If you encounter any issues or have feature requests, please [create an issue](https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle/issues) on the GitHub repository.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the Apache License 2.0 - see the [LICENSE](LICENSE) file for details.