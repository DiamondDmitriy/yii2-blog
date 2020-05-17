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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'comments_post'], 'integer'],
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


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'comments_post' => $this->comments_post,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'cover_img_url', $this->cover_img_url])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'creater_id', $this->creater_id])
            ->andFilterWhere(['like', 'genre', $this->genre]);

        return $dataProvider;
    }
}
