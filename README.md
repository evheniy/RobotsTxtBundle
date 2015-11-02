RobotsTxtBundle
=================

This bundle provides robots.txt generator for Symfony2

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