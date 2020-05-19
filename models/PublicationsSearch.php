<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publications;

/**
 * PublicationsSearch represents the model behind the search form of `app\models\Publications`.
 */
class PublicationsSearch extends Publications
{

    public $sortField = 'id';
    public $orderSort = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'cover_img_url', 'summary', 'content', 'creater_id', 'genre', 'data_create'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Publications::find();
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [$this->sortField => ($this->orderSort)?SORT_ASC : SORT_DESC]],
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // $ascDate;
        // $ascWatch;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'cover_img_url', $this->cover_img_url])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'creater_id', $this->creater_id])
            ->andFilterWhere(['like', 'genre', $this->genre])
            ->andFilterWhere(['like', 'watch', $this->watch]);


        return $dataProvider;
    }
}
