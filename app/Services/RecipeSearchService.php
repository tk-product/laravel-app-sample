<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class RecipeSearchService
{
    public function searchRecipes(string $word): array
    {
        $query = <<<SQL
WITH split_terms AS (
  SELECT regexp_split_to_table(:word, '\s+') AS term
),
recipe AS (
    SELECT
        recipe_id,
        recipe_name,
        description
    FROM
        recipe
    WHERE
        recipe_name ILIKE ANY (
            SELECT '%' || term || '%' FROM split_terms
        )
        OR
        description ILIKE ANY (
            SELECT '%' || term || '%' FROM split_terms
        )
)
SELECT
    re.recipe_id,
    re.recipe_name,
    ing.ingredient_name,
    re_ing.quantity
FROM
    recipe_ingredient AS re_ing
    INNER JOIN ingredient AS ing
        ON re_ing.ingredient_id = ing.ingredient_id
    INNER JOIN recipe AS re
        ON re_ing.recipe_id = re.recipe_id
;
SQL;

        return DB::select($query, ['word' => $word]);
    }
}
