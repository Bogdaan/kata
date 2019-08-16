using System;

namespace Decorator
{
    internal interface Pizza
    {
        void Cook();
    }

    internal class Dough : Pizza
    {
        public void Cook()
        {
            Console.WriteLine("Init dough");
        }
    }

    internal abstract class PizzaDecorator : Pizza
    {
        private readonly Pizza decorated;

        protected PizzaDecorator(Pizza pizza)
        {
            decorated = pizza;
        }

        protected abstract void AddIngridient();
        
        public void Cook()
        {
            decorated.Cook();
            AddIngridient();
        }
    }
    
    internal class BaconPizzaDecorator: PizzaDecorator
    {
        public BaconPizzaDecorator(Pizza pizza) : base(pizza)
        {
        }

        protected override void AddIngridient()
        {
            Console.WriteLine("Add bacon");
        }
    }

    internal class CheesePizzaDecorator: PizzaDecorator
    {
        public CheesePizzaDecorator(Pizza pizza) : base(pizza)
        {
        }

        protected override void AddIngridient()
        {
            Console.WriteLine("Add Cheese");
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Pizza pizza = new BaconPizzaDecorator(new CheesePizzaDecorator(new Dough()));
            pizza.Cook();
        }
    }
}