<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpClient\HttpClient;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $marks = $this->askApi('marks','Mark');
        $body = $this->askApi('body_types','Body Type');
        $engine = $this->askApi('engine_sizes', 'Engine Size');

        $builder
            ->add('srchText',null,array('label' => false))
            ->add('mark',ChoiceType::class,['choices' => $marks,'label' => false])
            ->add('bodyType',ChoiceType::class,['choices' => $body,'label' => false])
            ->add('engineSize',ChoiceType::class,['choices' => $engine,'label' => false]);
    }

    public function askApi($table,$name)
    {
        $client = HttpClient::create();
        $respone = $client->request('GET','http://localhost:8080/api/'.$table);
        $body = $respone->getContent();
        $data = json_decode($body,true);
        $data = $data['hydra:member'];
        $done = array($name => []);
        $done[$name] = array_merge($done[$name],['None' => 0]);
        foreach ($data as $elem)
        {
            $do = $done[$name];
            $done[$name] = array_merge($do,[$elem['name'] => $elem['id']]);
        }
        return $done;
    }
}