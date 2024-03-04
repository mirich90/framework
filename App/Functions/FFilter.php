<?

namespace App\Functions;

class FFilter
{
    const FIELDS = [
        'category' => ['category_id', "(SELECT id FROM categories WHERE `index` = 'other')"]
    ];

    static public function parse($fields_array)
    {
        if (count($fields_array) === 0) {
            return [];
        }

        foreach ($fields_array as $key => &$value) {
            $value_array = explode(",", $value);
            foreach ($value_array as $key => &$value) {
                if (isset(static::FIELDS[$value])) {
                    c($key);
                    unset($fields_array[$key]);
                    $new_key = static::FIELDS[$value][0];
                    $fields_array[$new_key] = static::FIELDS[$value][1];
                }
            }
        }
        unset($value);

        $parsed_fields = implode(",", $fields_array);
        return ($parsed_fields === '') ? '' : "ORDER BY $parsed_fields";
    }
}
