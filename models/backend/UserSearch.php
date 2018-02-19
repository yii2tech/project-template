<?php

namespace app\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\User;

/**
 * UserSearch represents the model behind the search form about `app\models\db\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $username;
    public $email;
    public $authKey;
    public $organization;
    public $statusId;
    public $createdAt;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'statusId'], 'integer'],
            [$this->attributes(), 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // status
        if (empty($this->statusId)) {
            $query->andFilterWhere(['not', ['statusId' => User::STATUS_DELETED]]);
        } elseif($this->statusId > 0) {
            $query->andFilterWhere(['statusId' => $this->statusId]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'authKey', $this->authKey]);

        return $dataProvider;
    }
}
