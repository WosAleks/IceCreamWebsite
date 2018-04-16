<?php
/**
 * Created by PhpStorm.
 * User: wosa2
 * Date: 15-Apr-18
 * Time: 4:00 PM
 */

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\IceCream;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadFixtures extends Fixture
{
    /**
     * Password encoder
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    private function encodePassword($user, $plainPassword):string
    {
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }

    public function load(ObjectManager $manager)
    {
        // Loads users
        $faker = \Faker\Factory::create(); //gets fake names from here

        $user1 = $this->createUser('aaa', 'aaa', ['ROLE_USER']);
        $user2 = $this->createUser('ola', 'ola', ['ROLE_ADMIN']);
        $user3 = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);

        for ($i=0; $i < 7; $i++) { //generates 7 fake users
            $user = $this->createUser($faker->firstName, $i, ['ROLE_USER']);

            $manager->persist($user);
        }

        // Loads Ice Cream
        $icecream1 = $this->createIceCream(
            $user1, // user_id
            'Cadbury Vanilla Chocolate Ice Cream Bar', // name
            'Cadbury', // brand
            'Vanilla Chocolate', // flavour
            'The chocolate coating was good, but the interior was not.', // summary
            '4.99', // price
            'The chocolate covering the ice cream is rich and delicious and does not taste fake like other products. However, the ice cream had no flavor and left an odd aftertaste.', // description
            'Fresh full cream milk, Liquid sugar(Sugar Water), Cream,, Glucose(Maize), Maltodextrin(Maize), Milk solids, Emulsifiers(477, 471), Flavour, Thickeners(412, 407a), Colours(160a, 100)', // ingredients
            'CadburyVanillaChocolate.jpeg', // photo
            '1'// public
		);

        $icecream2 = $this->createIceCream(
            $user2, // user_id
            'Haagen-Dazs Ice Cream', // name
            'Haagen-Dazs', // brand
            'Vanilla', // flavour
            'This ice cream was heaven and you should not disagree.', // summary
            '6.20', // price
            'The creaminess and even the colour made this ice cream feel like sin.', // description
            'Cream, Sugar, Concentrated skim milk, Liquid egg yolk, Vanilla extract, Ground Vanilla beans', // ingredients
            'HaagenDazs.jpg', // photo
            0 // public
		);

        $icecream3 = $this->createIceCream(
            $user1, // user_id - ignore
            'Hazelbrook Farm', // name
            'HB', // brand
            'Vanilla', // flavour
            'A disaster', // summary
            '2.50', // price
            'The cheap price reflects the ice creams taste, cheap and artificial', // description
            'Liquid Sugar, Concentrated skim milk, Vanilla extract, Flavour, Thickeners(412, 407a)', // ingredients
            'Hazelbrook.jpg', // photo
            1 // public
		);

        $icecream4 = $this->createIceCream(
            $user1, // user_id
            'Tesco Madagascan Vanilla', // name
            'Tesco', // brand
            'Vanilla', // flavour
            'A cheaper Haagen-Dazs', // summary
            '2.5', // price
            'A glance at the packaging suggests that it is a rival to Haagen-Dazs, but it is nowhere near. It is watery and bland tasting.', // description
            'Whole Milk, Double Cream (Milk)(34%), Demerara sugar, Dried skimmed milk, Pasteurised free range egg, Sugar, Madagascan vanilla(0.8%)(Vanilla extract, Ground vanilla pods)', // ingredients
            'Madagascan.jpg', // photo
            1// public
		);

        $icecream5 = $this->createIceCream(
            $user2, // user_id
            'Marks and Spencer Madagascan Vanilla', // name
            'Marks and Spencer', // brand
            'Vanilla', // flavour
            'A true delight', // summary
            '5.5', // price
            'An excellent product, worth every cent. It is close in taste to Haagen-Dazs, but the vanilla is much stronger tasting.', // description
            'Double cream(Milk)(78%), Skimmed milk, Sugar, Madagascan vanilla extract, Gelling agent(Carrageerian), Stabiliser(Xanthan Gum), Dextrose', // ingredients
            'MSMadagascan.jpg', // photo
            0 // public
		);

        $icecream6 = $this->createIceCream(
            $user2, // user_id
            'Edys Chocolate Chip Ice Cream', // name
            'Edys', // brand
            'Chocolate Chip', // flavour
            'About what you would expect for that price', // summary
            '4.5', // price
            'Hopes were high when buying, as slow churned means extra creamy, right? The assumption was correct, however the ice cream feels mire like ice than cream.', // description
            'Skim milk, Cream, Sugar, Chocolate chips(cocoa, coconut, sugar), Corn syrup, Whey, Guar gum, Carob bean gum, Carrrageenan, Annato colour, Natural Flavours', // ingredients
            'Edys.jpg', // photo
            1// public
		);

        $icecream7 = $this->createIceCream(
            $user, // user_id
            'Ben and Jerrys Chocolate Fudge Brownie', // name
            'Ben and Jerrys', // brand
            'Chocolate Fudge Brownie', // flavour
            'A crazy good flavour', // summary
            '3.5', // price
            'Ben and Jerrys are well known for weird flavours, and for their products tasting good. This Chocolate Fudge Brownie tastes exactly as described, while also being an ice cream.', // description
            'Cream(25%), Water, Sugar, Condensed skimmed milk, Cocoa powder, Wheat flour, fat reduced cocoa powder, soybean oil, free range egg yolk, invert sugar, egg, dried egg white, stabilisers(guar gum, carrageenan), salt, vanilla extract, raising agent(sodium bicarbonate), Barley flour', // ingredients
            'BenJerrys.jpeg', // photo
            0 // public
		);

        $icecream8 = $this->createIceCream(
            $user1, // user_id - ignore
            'Breyers Natural Strawberry Ice Cream', // name
            'Breyers', // brand
            'Strawberry', // flavour
            'Not bad, but relatively bland', // summary
            '6.5', // price
            'The box hilights that no hormones were used on cows which produce the ingredients for this ice cream, and that seems to be the main selling poion as the ice cream is rather bland.', // description
            'Milk, Strawberries, Cream, Sugar, Whey, Vegetable gum(Tara)', // ingredients
            'NaturalStrawberry.jpg', // photo
            1// public
		);

        $manager->persist($icecream1); //adds ice cream to manager
        $manager->persist($icecream2);
        $manager->persist($icecream3);
        $manager->persist($icecream4);
        $manager->persist($icecream5);
        $manager->persist($icecream6);
        $manager->persist($icecream7);
        $manager->persist($icecream8);

        // Create reviews
        $review1 = $this->createReview(
            $user1, // user_id
            $icecream1, // icecream_id
            'The chocolate coating was good, but the interior was not.', // summary
            new \DateTime('2017-03-21'), // date - ignore
            'Wallmart', // shop
            '2',
            '30', // stars - Eg. 1, 3.5, 4, 5
            1// public - ignore
		);

        $review2 = $this->createReview(
            $user1, // user_id
            $icecream2, // icecream_id
            'This ice cream was heaven and you should not disagree.', // summary
            new \DateTime('2017-03-21'), // date
            'Lidl', // shop
            '3',
            '50', // stars - Eg. 1, 3.5, 4, 5
            1 // public
		);

        $review3 = $this->createReview(
            $user2, // user_id
            $icecream3, // icecream_id
            'A disaster', // summary
            new \DateTime('2017-03-21'), // date - ignore
            'Tesco', // shop
            1.5,
            '20', // stars - Eg. 1, 3.5, 4, 5
            0 // public - ignore
		);

        $review4 = $this->createReview(
            $user1, // user_id
            $icecream4, // icecream_id
            'A cheaper Haagen-Dazs', // summary
            new \DateTime('2017-03-21'), // date
            'Tesco', // shop
            2.4,
            '15', // stars - Eg. 1, 3.5, 4, 5
            0// public
		);

        $review5 = $this->createReview(
            $user2, // user_id
            $icecream5, // icecream_id
            'A true delight', // summary
            new \DateTime('2017-03-21'), // date
            'Marks and Spencer', // shop
            '3.4',
            '50', // stars - Eg. 1, 3.5, 4, 5
            1 // public
		);

        $review6 = $this->createReview(
            $user1, // user_id
            $icecream6, // icecream_id
            'About what you would expect for that price', // summary
            new \DateTime('2017-03-21'), // date
            'Tesco', // shop
            1.4,
            '25', // stars - Eg. 1, 3.5, 4, 5
            0 // public - ignore
		);

        $review7 = $this->createReview(
            $user2, // user_id
            $icecream7, // icecream_id
            'A crazy good flavour', // summary
            new \DateTime('2017-03-21'), // date
            'Centra', // shop
            3.2,
            '40', // stars - Eg. 1, 3.5, 4, 5
            1 // public
		);

        $review8 = $this->createReview(
            $user3, // user_id
            $icecream8, // icecream_id
            'Not bad, but relatively bland', // summary
            new \DateTime('2017-03-21'), // date - ignore
            'Centra', // shop
            2.1,
            '35', // stars - Eg. 1, 3.5, 4, 5
            1 // public - ignore
		);

        $manager->persist($review1);
        $manager->persist($review2);
        $manager->persist($review3);
        $manager->persist($review4);
        $manager->persist($review5);
        $manager->persist($review6);
        $manager->persist($review7);
        $manager->persist($review8);

        $manager->flush(); //runs all reviews
    }

    public function createUser($username, $password, $roles = ['ROLE_USER']) {
        $user = new User();
        $user->setUsername($username);
        $encodedPassword = $this->encodePassword($user, $password);
        $user->setPassword($encodedPassword);
        $user->setRoles($roles);

        return $user;
    }

    public function createIceCream($user, $name, $brand, $flavour, $summary, $price, $description, $ingrediants, $photo, $public){
        $icecream = new IceCream();

        $icecream->setUser($user);
        $icecream->setName($name);
        $icecream->setBrand($brand);
        $icecream->setFlavour($flavour);
        $icecream->setSummary($summary);
        $icecream->setPrice($price);
        $icecream->setDescription($description);
        $icecream->setIngredients($ingrediants);
        $icecream->setPhoto($photo);
        $icecream->setPublic($public);

        return $icecream;
    }

    public function createReview($user, $icecream, $summary, $date, $shop, $price, $stars, $public) {
        $review = new Review();

        $review->setUser($user);
        $review->setIcecream($icecream);
        $review->setSummary($summary);
        $review->setDate($date);
        $review->setShop($shop);
        $review->setPrice($price);
        $review->setStars($stars);
        $review->setPublic($public);

        return $review;
    }


}