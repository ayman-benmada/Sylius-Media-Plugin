Example
=======================

In this example we will add a logo to the PaymentMethod entity :

Add a new property to the PaymentMethod entity **App\Entity\Payment\PaymentMethod.php** :

```php
<?php

declare(strict_types=1);

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Abenmada\MediaPlugin\Entity\Media\Media;
use Sylius\Component\Core\Model\PaymentMethod as BasePaymentMethod;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_payment_method")
 */
class PaymentMethod extends BasePaymentMethod
{
    /**
     * @ORM\ManyToOne(targetEntity=Media::class, inversedBy="paymentMethods")
     * @ORM\JoinColumn(name="logo_id", nullable=true, onDelete="SET NULL")
     */
    private ?Media $logo = null;

    public function getLogo(): ?Media
    {
        return $this->logo;
    }

    public function setLogo(?Media $logo): void
    {
        $this->logo = $logo;
    }
}
```

Customize the PaymentMethod form by creating **App\Form\Extension\PaymentMethodExtension.php** :

```php
<?php

declare(strict_types=1);

namespace App\Form\Extension;

use Abenmada\MediaPlugin\Entity\Media\MediaTypeInterface;
use Abenmada\MediaPlugin\Form\Choice\MediaChoiceType;
use Sylius\Bundle\PaymentBundle\Form\Type\PaymentMethodType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class PaymentMethodExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('logo', MediaChoiceType::class, [
                'required' => false,
                'multiple' => false,
                'row_attr' => [
                    'channels' => ['FASHION_WEB'],          // List of channel codes, by default all
                    'tags' => ['payment_method'],           // List of tag codes, by default all
                    'types' => [MediaTypeInterface::IMAGE], // List of media types, by default all
                ],
            ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [PaymentMethodType::class];
    }
}
```

```yaml
services:
    app.form.extension.type.payment_method:
        class: App\Form\Extension\PaymentMethodExtension
        tags:
            - { name: form.type_extension, extended_type: Sylius\Bundle\PaymentBundle\Form\Type\PaymentMethodType }
```

Customize the template **@SyliusAdmin/PaymentMethod/_form.html.twig** by adding :

```html
{% import "@MediaPlugin/Admin/Macro/media.html.twig" as media %}

{{ media.addModal() }}

<div class="ui segment">
    <h4 class="ui dividing header">{{ 'sylius.ui.media'|trans }}</h4>

    {{ media.addField(form.logo, 'app.ui.logo', false) }}
</div>
```

Run the migration :
```bash
bin/console doctrine:migration:diff
bin/console doctrine:migration:migrate
```
