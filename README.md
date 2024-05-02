<h1>Media plugin</h1>

<p>
    The Media plugin provides a library to manage your media
</p>

## Example

Here you will find <strong><a href="https://github.com/ayman-benmada/Sylius-Media-Plugin/blob/main/docs/example.md">example</a></strong> that allow you to add media to any form.

## Installation

Require plugin with composer :

```bash
composer require abenmada/media-plugin
```

Change your `config/bundles.php` file to add the line for the plugin :

```php
<?php

return [
    //..
    Abenmada\MediaPlugin\MediaPlugin::class => ['all' => true],
]
```

Then create the config file in `config/packages/abenmada_media_plugin.yaml` :

```yaml
imports:
    - { resource: "@MediaPlugin/Resources/config/services.yaml" }
```

Then import the routes in `config/routes/abenmada_media_plugin.yaml` :

```yaml
abenmada_media_plugin_routing:
    resource: "@MediaPlugin/Resources/config/routes.yaml"
    prefix: /%sylius_admin.path_name%
```

Update the entity `src/Entity/Channel/Channel.php` :

```php
<?php

declare(strict_types=1);

namespace App\Entity\Channel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Abenmada\MediaPlugin\Model\Channel\ChannelTrait as AbenmadaMediaChannelTrait;
use Sylius\Component\Core\Model\Channel as BaseChannel;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_channel")
 */
class Channel extends BaseChannel
{
    use AbenmadaMediaChannelTrait;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
        parent::__construct();
    }
}
```

Run the migration :
```bash
bin/console doctrine:migration:migrate
```
