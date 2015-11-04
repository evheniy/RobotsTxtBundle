RobotsTxtBundle
=================

This bundle provides robots.txt generator for Symfony2

[![knpbundles.com](http://knpbundles.com/evheniy/RobotsTxtBundle/badge)](http://knpbundles.com/evheniy/RobotsTxtBundle)

[![Latest Stable Version](https://poser.pugx.org/evheniy/robots-txt-bundle/v/stable)](https://packagist.org/packages/evheniy/robots-txt-bundle) [![Total Downloads](https://poser.pugx.org/evheniy/robots-txt-bundle/downloads)](https://packagist.org/packages/evheniy/robots-txt-bundle) [![Latest Unstable Version](https://poser.pugx.org/evheniy/robots-txt-bundle/v/unstable)](https://packagist.org/packages/evheniy/robots-txt-bundle) [![License](https://poser.pugx.org/evheniy/robots-txt-bundle/license)](https://packagist.org/packages/evheniy/robots-txt-bundle)

[![Build Status](https://travis-ci.org/evheniy/RobotsTxtBundle.svg)](https://travis-ci.org/evheniy/RobotsTxtBundle)
[![Coverage Status](https://coveralls.io/repos/evheniy/RobotsTxtBundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/evheniy/RobotsTxtBundle?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/evheniy/RobotsTxtBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/evheniy/RobotsTxtBundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/evheniy/RobotsTxtBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/evheniy/RobotsTxtBundle/build-status/master)

Installation
------------

    $ composer require evheniy/robots-txt-bundle "1.*"

Or add to composer.json

    "evheniy/robots-txt-bundle": "1.*"

AppKernel:

    public function registerBundles()
        {
            $bundles = array(
                ...
                new Evheniy\RobotsTxtBundle\RobotsTxtBundle(),
                ...
            );
            ...
    ...

config.yml:

    robots_txt:
      - 'User-agent: *'

Or with sitemap:

    robots_txt:
      - 'User-agent: *'
      - 'Sitemap: http://test.com/sitemap.xml'
      
The last step

    app/console robots.txt:dump
    

Using different environments
-----------------------------

The main idea is to use robots.txt for different environments, for example: for *dev* hiding project from indexing robots like Google

**config_prod.yml**:

    robots_txt:
      - 'User-agent: *'
      - 'Sitemap: http://test.com/sitemap.xml'

**config_dev.yml**:

    robots_txt:
      - 'User-agent: *'
      - 'Disallow: /'

And run it for **prod**:

    app/console robots.txt:dump --env=prod
    
And run it for **dev**:

    app/console robots.txt:dump --env=dev
    
Or just

    app/console robots.txt:dump


License
-------

This bundle is under the [MIT][3] license.

[Документация на русском языке][1]

[Demo][2]

[Build a robots.txt][4]

[1]:  http://makedev.org/articles/symfony/bundles/robots_txt_bundle.html
[2]:  http://makedev.org/robots.txt
[3]:  https://github.com/evheniy/RobotsTxtBundle/blob/master/Resources/meta/LICENSE
[4]:  https://support.google.com/webmasters/answer/6062596