<?php

/*
 * 2021 Mar 9
 * File: PortfoliosSearch.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Feedbacks;

/**
 * Description of PortfoliosSearch
 *
 * @author Александр
 */
class FeedbacksSearch extends Feedbacks
{
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Feedbacks::find()->andWhere(['active' => 1])->orderBy(['order' => SORT_DESC]); 
               
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);      
        
        return $dataProvider;
    }
    
}
