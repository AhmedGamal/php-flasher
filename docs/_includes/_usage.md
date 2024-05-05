## <i class="fa-duotone fa-list-radio"></i> Usage

To display a notification message, you can either use the `flash()` helper method or obtain an instance of `flasher` from the service container. 
Then, before returning a view or redirecting, call the `success()` method and pass in the desired message to be displayed.

{% assign id = '#/ PHPFlasher' %}
{% assign type = 'success' %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
{{ id }}

use Flasher\Prime\FlasherInterface;

class BookController
{
    public function saveBook()
    {
        // ...

        flash()->success('{{ site.data.messages["success"] | sample }}');

        flash('{{ message }}');

        // ... redirect or render the view
    }
    
    /**
     * if you prefer to use dependency injection 
     */
    public function register(FlasherInterface $flasher)
    {
        // ...

        $flasher->success('{{ site.data.messages["success"] | sample }}');

        // ... redirect or render the view
    }
}
```

<br />

It's important to choose a message that is clear and concise, and that accurately reflects the outcome of the operation. <br />
In this case, `"Book has been created successfully!"` is already a good message,
but you may want to tailor it to fit the specific context and language of your application.

> Using this package is actually pretty easy. Adding notifications to your application actually require only one line of code.

{% assign id = '#/ usage success' %}
{% assign type = 'success' %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
{{ id }}

flash()->{{ type }}('{{ message }}');
```

{% assign id = '#/ usage error' %}
{% assign type = 'error' %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
{{ id }}

flash()->{{ type }}('{{ message }}');
```

{% assign id = '#/ usage warning' %}
{% assign type = 'warning' %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
{{ id }}

flash()->{{ type }}('{{ message }}');
```

{% assign id = '#/ usage info' %}
{% assign type = 'info' %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
{{ id }}

flash()->{{ type }}('{{ message }}');
```

---

These four methods `success()`, `error()`, `warning()`, `info()` are simply convenience shortcuts for the `flash()` method, 
allowing you to specify the `type` and `message` in a single method call rather than having to pass both as separate arguments to the `flash()` method. 

```php
flash()->flash(string $type, string $message, string $title = null, array $options = [])
```

{% assign id = '#/ usage flash' %}
{% assign type = site.data.messages.types | sample %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
{{ id }}

flash()->flash('{{ type }}', '{{ message }}');
```

| param      | description                                                                                                                                                                                                                                                                                                 |
|------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$type`    | Notification type : <span class="text-white bg-green-600 px-2 py-1 rounded">success</span>, <span class="text-white bg-red-600 px-2 py-1 rounded">error</span>, <span class="text-white bg-yellow-600 px-2 py-1 rounded">warning</span>, <span class="text-white bg-blue-600 px-2 py-1 rounded">info</span> |
| `$message` | The body of the message you want to deliver to your user. This may contain HTML. If you add links, be sure to add the appropriate classes for the framework you are using.                                                                                                                                  |
| `$title`   | The notification title, Can also include HTML                                                                                                                                                                                                                                                               |
| `$options` | Custom options for javascript libraries (toastr, noty, notyf ...etc)                                                                                                                                                                                                                                        |


--- 

<p id="method-options"><a href="#method-options" class="anchor"><i class="fa-duotone fa-link"></i> options</a></p>

The `options()` method allows you to set multiple options at once by passing an array of `key-value` pairs, 
while the `option()` method allows you to set a single option by specifying its name and value as separate arguments. <br /><br />
The optional `$append` argument for the `options()` method can be used to specify whether the new options should be appended to any existing options, 
or whether they should overwrite them.

```php
flash()->options(array $options, bool $append = true);
```


{% assign id = '#/ usage options' %}
{% assign type = site.data.messages.types | sample %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{"timeout": 3000, "position": "top-center"}' %}
{% include example.html %}

```php
{{ id }}

flash()
    ->options([
        'timeout' => 3000, // 3 seconds
        'position' => 'top-center',
    ])
    ->{{ type }}('{{ message }}');
```
---

<p id="method-option"><a href="#method-option" class="anchor"><i class="fa-duotone fa-link"></i> option</a></p>

Set a single option by specifying its name and value as separate arguments.

```php
flash()->option(string $option, mixed $value);
```

{% assign id = '#/ usage option' %}
{% assign type = site.data.messages.types | sample %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{"timeout": 3000, "position": "bottom-right"}' %}
{% include example.html %}

```php
{{ id }}

flash()
    ->option('position', 'bottom-right')
    ->option('timeout', 3000)
    ->{{ type }}('{{ message }}');
```

---

<p id="method-priority"><a href="#method-priority" class="anchor"><i class="fa-duotone fa-link"></i> priority</a></p>

Sets the priority of a flash message, the highest priority will be displayed first.

```php
flash()->priority(int $priority);
```

{% assign id = '#/ usage priority' %}
{% assign successMessage = site.data.messages['success'] | sample | prepend: 'Priority 3 → ' %}
{% assign errorMessage = site.data.messages['error'] | sample | prepend: 'Priority 1 → ' %}
{% assign warningMessage = site.data.messages['warning'] | sample | prepend: 'Priority 4 → ' %}
{% assign infoMessage = site.data.messages['info'] | sample | prepend: 'Priority 2 → ' %}

<script type="text/javascript">
    messages["{{ id }}"] = [
        {
            handler: "flasher",
            type: "warning",
            message: "{{ warningMessage }}",
            options: {},
        },
        {
            handler: "flasher",
            type: "success",
            message: "{{ successMessage }}",
            options: {},
        },
        {
            handler: "flasher",
            type: "info",
            message: "{{ infoMessage }}",
            options: {},
        },
        {
            handler: "flasher",
            type: "error",
            message: "{{ errorMessage }}",
            options: {},
        },
    ];
</script>

```php
{{ id }}

flash()
    ->priority(3)
    ->success('{{ successMessage }}');

flash()
    ->priority(1)
    ->error('{{ errorMessage }}');

flash()
    ->priority(4)
    ->warning('{{ warningMessage }}');

flash()
    ->priority(2)
    ->info('{{ infoMessage }}');
```

| param       | description                                                                                |
|-------------|--------------------------------------------------------------------------------------------|
| `$priority` | The priority of the notification, the higher the priority, the sooner it will be displayed |

---

<p id="method-hops"><a href="#method-hops" class="anchor"><i class="fa-duotone fa-link"></i> hops</a></p>

This method sets the number of requests that the flash message should persist for. By default, flash messages are only displayed for a single request and are then discarded. By setting the number of hops, the flash message will be persisted for multiple requests.

As an example, with a multi-page form, you may want to store messages until all pages have been filled.

{% assign id = '#/ usage hops' %}
{% assign type = site.data.messages.types | sample %}
{% assign message = site.data.messages[type] | sample %}
{% assign options = '{}' %}
{% include example.html %}

```php
flash()->hops(int $hops);
```

```php
flash()
    ->hops(2)
    ->{{ type }}('{{ message }}');
```

| param   | description                                                   |
|---------|---------------------------------------------------------------|
| `$hops` | indicate how many requests the flash message will persist for |

---

<p id="method-translate"><a href="#method-translate" class="anchor"><i class="fa-duotone fa-link"></i> translate</a></p>

This method sets the `locale` to be used for the translation of the flash message. If a non-null value is provided, 
the flash message will be translated into the specified language. If null is provided, the **default** `locale` will be used.

```php
flash()->translate(string $locale = null);
```

{% assign id = '#/ usage translate' %}
{% assign type = 'success' %}
{% assign message = 'تمت العملية بنجاح.' %}
{% assign title = 'تهانينا' %}
{% assign options = '{"rtl": true, "position": "top-right"}' %}
{% include example.html %}

```php
{{ id }}

flash()
    ->translate('ar')
    ->{{ type }}('Your request was processed successfully.', 'Congratulations!');
```

{% assign id = '#/ usage translate with position' %}
{% assign type = 'success' %}
{% assign message = 'تمت العملية بنجاح.' %}
{% assign title = 'تهانينا' %}
{% assign options = '{"rtl": true, "position": "top-left"}' %}
{% include example.html %}

```php
{{ id }}

flash()
    ->translate('ar')
    ->option('position', 'top-left')
    ->{{ type }}('Your request was processed successfully.', 'Congratulations!');
```

| param     | description                                                                  |
|-----------|------------------------------------------------------------------------------|
| `$locale` | The locale to be used for the translation, or null to use the default locale |

It is **important** to note that the `translate()` method only sets the locale to be used for the translation of the flash message. 
It does not actually perform the translation itself.

In order to translate the flash message, you will need to provide the appropriate translation keys in your translation files.

{% if page.framework == 'laravel' %}

In the above example, to translate the flash message into `Arabic`, you will need to add the following keys to the `resources/lang/ar/messages.php` file:

```php
return [
    'Your request was processed successfully.' => 'تمت العملية بنجاح.',
    'Congratulations!' => 'تهانينا',
];
```

{% elsif page.framework == 'symfony' %}

In the above example, to translate the flash message into `Arabic`, you will need to add the following keys to the `translations/messages.ar.yaml` file:

```yaml
Your request was processed successfully.: 'تمت العملية بنجاح.'
Congratulations!: 'تهانينا'
```

{% endif %}

