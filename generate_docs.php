<?php

/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnhandledExceptionInspection */
require __DIR__.'/vendor/autoload.php';

$factory = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
$reflection = new ReflectionClass(\Str\Str::make(''));

// -------------------------------------
$templateDocument = <<<RAW
%about%

---------------------

%install%

%features%

---------------------

## Functions Index:
%__functions_index__%

## Functions List:
%__functions_list__%

---------------------

%benchmark%

%development%
RAW;
$templateMethodParam = <<<RAW
- %param%
RAW;
$templateMethodReturn = <<<RAW
- %return%
RAW;
$templateMethod = <<<RAW
## :small_blue_diamond: %name%
%description%

**Parameters:**
%params%

**Return:**
%return%
--------
RAW;
$templateIndexLink = <<<RAW
- <a href="%href%">%title%</a>
RAW;

// -------------------------------------

class TemplateFormatter
{
    /** @var array */
    private $vars = [];

    /** @var string */
    private $template;

    /**
     * @param string $template
     */
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param string $var
     * @param string $value
     *
     * @return mixed
     */
    public function set(string $var, string $value): self
    {
        $this->vars[$var] = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function format(): string
    {
        $s = \Str\Str::make($this->template);

        foreach ($this->vars as $name => $value) {
            $s->replace(sprintf('%%%s%%', $name), $value);
        }

        return $s->getString();
    }
}

// -------------------------------------

$functionsDocumentation = [];
$functionsIndex = [];

foreach ($reflection->getMethods() as $method) {
    if (!$method->isPublic()) {
        continue;
    }

    $doc = $factory->create($method->getDocComment());

    $methodIndexTemplate = new TemplateFormatter($templateIndexLink);
    $methodIndexTemplate->set('title', $method->getShortName());
    $methodIndexTemplate->set('href', \Str\Str::make((string) $method->getShortName())
        ->toLowerCase()
        ->trim()
        ->stripWhitespace()
        ->prepend('#')
        ->getString()
    );

    $methodTemplate = new TemplateFormatter($templateMethod);
    $methodTemplate->set('name', $method->getShortName());
    $methodTemplate->set('description', $doc->getDescription());
    $methodTemplate->set('code', '```php echo ```');

    // -- params
    $params = [];
    foreach ($tagsInput = $doc->getTagsByName('param') as $tagParam) {
        $paramsTemplate = new TemplateFormatter($templateMethodParam);
        $paramsTemplate->set('param', (string) $tagParam);
        $params[] = $paramsTemplate->format();
    }

    if (0 !== \count($params)) {
        $methodTemplate->set('params', implode("\n", $params));
    } else {
        $methodTemplate->set('params', '__nothing__');
    }

    // -- return
    $returns = [];
    foreach ($tagsInput = $doc->getTagsByName('return') as $tagReturn) {
        $returnTemplate = new TemplateFormatter($templateMethodReturn);
        $returnTemplate->set('return', (string) $tagReturn);
        $returns[] = $returnTemplate->format();
    }

    if (0 !== \count($returns)) {
        $methodTemplate->set('return', implode("\n", $returns));
    } else {
        $methodTemplate->set('return', '__void__');
    }

    $functionsDocumentation[$method->getShortName()] = $methodTemplate->format();
    $functionsIndex[$method->getShortName()] = $methodIndexTemplate->format();
}

ksort($functionsDocumentation);
$functionsDocumentation = array_values($functionsDocumentation);

ksort($functionsIndex);
$functionsIndex = array_values($functionsIndex);

// -------------------------------------

$documentTemplate = new TemplateFormatter($templateDocument);
$documentTemplate->set('__functions_list__', implode("\n", $functionsDocumentation));
$documentTemplate->set('__functions_index__', implode("\n", $functionsIndex));

$directoryIterator = new RecursiveDirectoryIterator(__DIR__.'/docs/index');
$iterator = new IteratorIterator($directoryIterator);

foreach ($iterator as $docFile) {
    /* @var SplFileInfo $docFile */
    if ('md' === $docFile->getExtension()) {
        $sName = \Str\Str::make((string) $docFile->getFilename())->shift('.');

        $documentTemplate->set(
            $sName->toLowerCase()->getString(),
            sprintf(
                "## %s\n\n%s",
                $sName->titleize()->getString(),
                file_get_contents($docFile->getRealPath())
            )
        );
    }
}

file_put_contents(__DIR__.'/README.md', $documentTemplate->format());
