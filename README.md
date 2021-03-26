# nll-LoremIpsum
Lorem ipsum generator in PHP without dependencies. Compatible with PHP 5.3+.

## Installation


Then run `composer update`.

## Usage

### Getting Started

```php
$lipsum = new LoremIpsum();
```

### Generating Words

```php
echo '1 word: '  . $lipsum->word();
echo '5 words: ' . $lipsum->words(5);
```

### Generating Sentences

```php
echo '1 sentence: '  . $lipsum->sentence();
echo '5 sentences: ' . $lipsum->sentences(5);
```

**note :** Sentences are separated by dots.

### Generating Paragraphs

```php
echo '1 paragraph: '  . $lipsum->paragraph();
echo '5 paragraphs: ' . $lipsum->paragraphs(5);
```

### Wrapping Text with HTML Tags

If you would like to wrap the generated text with a tag, pass it as the second
parameter:

```php
echo $lipsum->paragraphs(3, 'p');

// Generates: <p>Lorem ipsum...</p>
```

### Return as an Array

Perhaps you want an array instead of a string:

```php
print_r($lipsum->wordsArray(5));
print_r($lipsum->sentencesArray(5));
print_r($lipsum->paragraphsArray(5));
```

You can still wrap with markup when returning an array:

```php
print_r($lipsum->wordsArray(5, 'en', 'li'));
```

### Language Support
The following languages are supported : ($language parameter)
- Armenian(Հայերեն)
  - hy
- Albanian (Shqip)
  - sq
- Arabic (العربية)
  - ar
- Bulgarian(Български)
  - bg
- Catalan(Català)
  - ca
- Simplified Chinese (中文简体)
  - cn
- Croatian (Hrvatski)
  - hr
- Czech (Česky)
  - cs
- Dansk
  - da
- Nederlands
  - nl
- English
  - en (default)
- Estonia (Eesti)
  - et
- Persian (فارسی)
  - fa
- Philippinisch (Filipino)
  - ph
- Finland (Suomi)
  - fl
- French (Français)
  - fr
- Georgian (ქართული)
  - ka
- German (Deutsch)
  - de
- Greek (Ελληνικά)
  - el
- Abrit (עברית)
  - he
- Hindi (हिन्दी)
  - hi
- Hungarian (Magyar)
  - hu
- Indonesia
  - id
- Italian (Italiano)
  - it
- Latviski
  - lv
- Lithuanian (Lietuviškai)
  - lt
- Macedonian (македонски)
  - mk
- Malay (Melayu)
  - ms
- Norsk
  - no
- Polish (Polski)
  - pl
- Portuguese (Português)
  - pt
- Romania (Româna)
  - ro
- Russian (Pyccкий)
  - ru
- Serbian (Српски)
  - sr
- Slovak (Slovenčina)
  - sk
- Slovene (Slovenščina)
  - sl
- Spanish (Español)
  - es
- Swedish (Svenska)
  - sw
- Thai (ไทย)
  - th
- Turkish (Türkçe)
  - tr
- Ukrainian (Українська)
  - uk
- Vietnamese (Tiếng Việt)
  - vi

**e.g:** Generating French Paragraph
```
echo $lipsum->paragraph('fr');
```
**e.g:** Generating Persian Sentence
```
echo $lipsum->sentence('fa');
```

## Assumptions

Strings are made of [fixed text](https://www.lipsum.com/).

## Contributing

Suggestions and bug reports are always welcome, but karma points are earned for
pull requests.

- `data.json` Lorem Ipsum text String.
- `LoremIpsum.php` Lorem Ipsum PHP Class

## Credits

`nll-LoremIpsum` was originally inspired by
[joshtronic/lorem-ipsum](https://github.com/joshtronic/php-loremipsum) with a
goal of being a dependency free lorem ipsum generator with flexible generation
options and multi language.


## License

MIT
