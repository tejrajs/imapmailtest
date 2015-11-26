<?php

namespace app\modules\mail\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MailDetail;

/**
 * MailDetailSearch represents the model behind the search form about `common\models\MailDetail`.
 */
class MailDetailSearch extends MailDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'active'], 'integer'],
            [['mail', 'imapLogin', 'imapPassword'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = MailDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'imapLogin', $this->imapLogin])
            ->andFilterWhere(['like', 'imapPassword', $this->imapPassword]);

        return $dataProvider;
    }
}
