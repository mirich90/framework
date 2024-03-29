<?

namespace App\Functions;

class FSort
{
    const FIELDS = [
        'updatedown' => 'datetime_update DESC',
        'updateup' => 'datetime_update ASC',
        'datedown' => 'datetime DESC',
        'dateup' => 'datetime ASC',
        'titledown' => 'title DESC',
        'titleup' => 'title ASC',
        'bookmarkdown' => 'count_bookmarks DESC',
        'bookmarkup' => 'count_bookmarks ASC',
        'likedown' => 'count_likes DESC',
        'likeup' => 'count_likes ASC',
    ];

    static public function getSort($sort)
    {
        $url = $_SERVER['REQUEST_URI'];

        if (isset($_GET['sort'])) {
            $get = $_GET['sort'];
            $url = str_replace("sort=$get", "sort=$sort", $url);
            return $url;
        }
        $symbol = (count($_GET) > 0) ? '&' : '?';
        return $url . $symbol . "sort=$sort";
    }

    static public function parse($fields)
    {
        if (count($fields) === 0 || !isset($fields['sort'])) {
            return '';
        }

        $fields_array = explode(",", $fields['sort']);
        foreach ($fields_array as $key => &$value) {
            if (isset(static::FIELDS[$value])) {
                $value = static::FIELDS[$value];
            } else {
                unset($fields_array[$key]);
            }
        }
        unset($value);

        $parsed_fields = implode(",", $fields_array);
        return ($parsed_fields === '') ? '' : "ORDER BY $parsed_fields";
    }
}
