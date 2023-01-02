<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Meal
 *
 * @property int $id
 * @property string $name 名稱
 * @property string $description 備註
 * @property int $price 價格
 * @property string $image_url 圖片位址
 * @property int $stock 庫存
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereUpdatedAt($value)
 */
	class Meal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $to
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $table_id
 * @property string|null $remark 備註
 * @property string $status 狀態
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderMeal[] $meals
 * @property-read int|null $meals_count
 * @property-read \App\Models\Table $table
 * @method static \Illuminate\Database\Eloquent\Builder|Order isProcessing()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderMeal
 *
 * @property int $id
 * @property int $order_id
 * @property int $meal_id
 * @property int $count 數量
 * @property string|null $remark 備註
 * @property string $status 狀態[待處理,處理中,已完成,已送達,已廢棄]
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meal $meal
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereMealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMeal whereUpdatedAt($value)
 */
	class OrderMeal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderWaiter
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWaiter whereUserId($value)
 */
	class OrderWaiter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Table
 *
 * @property int $id
 * @property string $name 桌號
 * @property int $capacity 容納人數
 * @property string $status 狀態[使用中,可使用,需清潔,已預定]
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereUpdatedAt($value)
 */
	class Table extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name 姓名
 * @property string|null $sex 性別[男, 女, 未知]
 * @property int|null $age 年齡
 * @property string $account 帳號或員編
 * @property string $password 密碼
 * @property string $role 職位[領檯人員,服務生,廚師,雜工,經理]
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

