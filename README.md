# Laravel Static Documentation Sites, Blazingly Fast and Stupidly Simple

<p>
	<img style="display: inline; margin: 4px 2px;" src="https://img.shields.io/packagist/v/desilva/laradocgen" alt="Latest Version on Packagist">
	<img style="display: inline; margin: 4px 2px;" src="https://img.shields.io/packagist/dt/desilva/laradocgen" alt="Total Downloads">
	<img style="display: inline; margin: 4px 2px;" src="https://img.shields.io/packagist/l/desilva/laradocgen" alt="License">
	<img style="display: inline; margin: 4px 2px;" src="https://github.com/caendesilva/laradocgen/actions/workflows/php.yml/badge.svg" alt="GitHub Actions">
	<img style="display: inline; margin: 4px 2px;" src="https://github.com/caendesilva/Laradocgen/actions/workflows/laravel-tests.yml/badge.svg" alt="GitHub Actions">
</p>

> Now with Dark Mode Support!

## Not activly maintained
This project is currently not receiving new features as I am focusing on [HydePHP](https://github.com/hydephp/hyde), however,
the project will continue to get security fixes indefinitely. Open source contributions are welcome!

### Alternatives 
This project is a hybrid static site generator and live server package. 
I have created two other packages that I think are much better suited than this one.

If you want static documentation sites, try out [HydePHP](http://hydephp.com/) which features a significantly faster rendering engine, and is much more refined and easy to get started with.

If you want documentation sites for a Laravel project, try [Lagrafo](https://github.com/caendesilva/lagrafo), which started out as Laradocgen v2.0.

## About

Hey! I'm Caen! I created this package to practice package development. It is still very much in beta, but please do send me any feedback you have! I'd love to get some PRs as well.

### Full Documentation
Full documentation is available at https://docs.desilva.se/laradocgen/. Generated using this package of course!

### Alpha Stage Software
Hey! Just a quick heads up that this is a very new package and I expect there to be bugs. If anything goes wrong, do let me know and I'd love to get feedback and PRs!

<small>
**Disclaimer**
This package is still in the alpha stage. Once it becomes stable and tested enough I will release v1.0 and I will adhere to semantic versioning. But until then I will run canary builds and I am sure there will be breaking changes. I will of course do my best to document them all in the upgrade guides, but all in all, at this stage I would not recommend it for production use. Though since it is intended to run on your local server I don't think much can go wrong as long as you have backups and Git. The only area that is really of concern to me is that since we are working with writing files to disk if something goes wrong files could be overwritten, but as it is now the paths are hardcoded to "safe" directories so it should only be able to overwrite files already created by the package.
</small>

## Installation
> The package has so far only been tested with Laravel 9

You can install the package via composer:
```bash
composer require desilva/laradocgen --dev
```

Publish the assets
```bash
php artisan vendor:publish --tag="laradocgen"
```

Build the static site
```bash
php artisan laradocgen:build
```
Your static site will be saved in `public/docs`

## Usage

### Adding pages
Pages are generated from markdown files stored in `resources/docs/`.

Markdown filenames are sanitized through Str::slug(). To prevent 404 errors the filenames must be compatible. In essence, they must be in lowercase kebab-case and end in .md and must not contain spaces.
```bash
❌ "kebab case title.markdown" # Returns 404
✔️ "kebab-case-title.md" # creates my-page-title.html and renders as "My Page Title" in the frontend
```

And store your images in `resources/docs/media/`
```markdown
![My Image](media/image.png "Image Title") # Note the relative path
```

### Build the static site
```bash
php artisan laradocgen:build
```
Your static site will be saved in `public/docs`

### Customization
The package strives to follow [Convention over configuration](https://en.wikipedia.org/wiki/Convention_over_configuration).
Everything is preconfigured so you can get started quickly. However, if you wish you can customize the package.

You can publish the Blade views using
```bash
php artisan publish --tag="laradocgen-views"
```
And customize them to your liking. Note that you will need to re-publish the views when updating!

You can customize the source and output directory in the config file.
You can use this to create multiple documentation versions.

## Package Development

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Roadmap
- [x] Allow the specification of source/build directories. This can also be used for versioning.
- [x] Document Blade [view customization](https://laravel.com/docs/9.x/packages#views)
- [ ] Add (automatic) versioning support
- [ ] Allow the package to run standalone from Laravel
- [ ] Add Search feature 
- [ ] Add Artisan command to create a new Markdown file based on an input title
- [ ] Add CLI options to the Artisan build command to override config settings on a per-build basis

Right now there are not very many customization options as I wanted to keep things dead simple.
If you have a configuration idea please do make a PR or open a GitHub Issue as I want to allow for more customization down the line.


## Security

If you discover any security-related issues, please email caen@desilva.se instead of using the issue tracker.
All vulnerabilities will be promptly addressed.

## Credits

-   [Caen De Silva](https://github.com/caendesilva)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Attributions
> Please see the respective authors' repositories for their license files

### Laravel Package Boilerplate

This package's scaffolding was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

### Frontend

- The frontend is based on the [Tailwind Starter Kit](https://github.com/creativetimofficial/tailwind-starter-kit) from Creative Tim (MIT)
- The dark-mode switch is based on a component from [Flowbite](https://flowbite.com/docs/customize/dark-mode/) (MIT)

### Packages used and special mentions
- The frontend is built with [TailwindCSS](https://tailwindcss.com/)
- Syntax highlighting by [Torchlight](https://torchlight.dev/)
- Markdown is parsed with [League/Commonmark](https://github.com/thephpleague/commonmark)
- The default favicon was created using [Favicon.io](https://favicon.io/) using the ["Page" Emoji](https://github.com/twitter/twemoji/blob/master/assets/svg/1f4c4.svg) from the amazing open-source project [Twemoji](https://twemoji.twitter.com/). The graphics are copyright 2020 Twitter, Inc and other contributors and are licensed under [CC-BY 4.0](https://creativecommons.org/licenses/by/4.0/).


## More Badges

<p>
	<img style="display: inline; margin: 4px 2px;" src="https://img.shields.io/packagist/v/desilva/laradocgen" alt="Latest Version on Packagist">
	<img style="display: inline; margin: 4px 2px;" src="https://img.shields.io/packagist/v/desilva/laradocgen?include_prereleases" alt="Latest Version on Packagist (including pre-releases)">
	<img style="display: inline; margin: 4px 2px;" src="https://github.com/caendesilva/Laradocgen/actions/workflows/pages/pages-build-deployment/badge.svg" alt="GitHub Actions">
</p>
