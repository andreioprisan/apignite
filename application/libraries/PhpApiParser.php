<?php

require_once 'PHP/Token/Stream/Autoload.php';
//'PHP/Token/Stream.php', 'PHP/Token.php',
// http://php.net/manual/en/function.glob.php Returns an array containing the matched files/directories, an empty array if no file matched or FALSE on error.
$filepaths = array('/Users/ewolfson/Projects/apignite/application/controllers/apis.php');

$api = array();

foreach ($filepaths as $filepath) {
    $ts = new PHP_Token_Stream($filepath);
    $classes = $ts->getClasses();
    // var_dump($classes);die;
    foreach($ts->getClasses() as $className => $classMeta) {
        if(array_key_exists('methods', $classMeta)) {
            $api[$className] = array();
            foreach($classMeta['methods'] as $name => $meta) {
                if ($meta['visibility'] === 'public' || empty($meta['visibility'])) {
                    $api[$className][$name] = $meta['arguments'];
                }

            }
        }
    }
}

// print("pre filtering");
// var_dump($api);

// Remove magic __methods
$magicMethod = function($methodName) {
    return ( strlen($methodName) >= 2 &&
        $methodName[0] === '_' && $methodName[0] === $methodName[1]
    );
};
foreach ($api as $class => $methods) {
    foreach($methods as $name => $meta) {
        if($magicMethod($name)) {
            unset($api[$class][$name]);
        }
    }
}

// Filter out classes without any public methods
$api = array_filter($api, function($class) {
    return !empty($class);
});

print("apis of given files are: ");
var_dump($api);
?>
