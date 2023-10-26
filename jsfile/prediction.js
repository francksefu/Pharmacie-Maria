
/*const checker = document.querySelector('#checker').value;

if(checker == 'prediction-periode') {
    const input_arr = document.querySelector('#data_in').value.split(',')
    const out_arr = document.querySelector('#data_out').value.split(',')

    long_table = input_arr.length;
    if(long_table > 10 ) {
        // 80% pour le training et 20% pour le test
        length_training = Math.ceil(long_table * (8 / 10))
        const trainingData = [];
        for(let i = 0; i < length_training; i++) {
            trainingData.push(
                [Number(new Date(input_arr[i])), out_arr[i] * 1]
            );
        }
       
        const result = regression.linear(trainingData);

        // Make predictions
        const inputToPredict = [ Number(new Date('2023-12-27'))];//1614800000; // Timestamp for a new date
        const predictedQuantity = result.predict(inputToPredict);
        document.getElementById("result").value = ('Predicted quantity sold:', predictedQuantity[1]);

    }
    

}*/


// Données de dates et de quantités vendues
const dates = ["2023-03-02", "2023-03-03", "2023-03-03", "2023-03-03", "2023-03-03", "2023-03-04", "2023-03-06", "2023-03-06", "2023-03-09", "2023-03-09", "2023-03-09", "2023-03-10", "2023-03-11"];
const quantitesVendues = [8, 7, 5, 3, 1, 1, 3, 13, 2, 1, 5, 5, 2];

// Conversion des dates en nombres de jours depuis une date de référence
const dateDeReference = new Date("2023-03-01");
const joursDepuisReference = dates.map(date => {
  const dateCourante = new Date(date);
  return (dateCourante - dateDeReference) / (24 * 60 * 60 * 1000); // Convertir en jours
});

// Préparer les données en séquences d'entrée et de sortie
const sequenceLength = 3; // Vous pouvez ajuster la longueur de la séquence
const X = [];
const y = [];

for (let i = 0; i < quantitesVendues.length - sequenceLength; i++) {
  const sequenceDates = joursDepuisReference.slice(i, i + sequenceLength);
  const sequenceQuantites = quantitesVendues.slice(i, i + sequenceLength);
  const quantiteAVendre = quantitesVendues[i + sequenceLength];
  X.push([...sequenceDates, ...sequenceQuantites]);
  y.push(quantiteAVendre);
}

// Conversion en tenseurs TensorFlow
const xTrain = tf.tensor(X);
const yTrain = tf.tensor(y);

// Créer et entraîner le modèle RNN (comme dans l'exemple précédent)
// ...
// Créer un modèle RNN simple avec TensorFlow.js
const model = tf.sequential();
model.add(tf.layers.lstm({ units: 50, inputShape: [sequenceLength, 1] }));
model.add(tf.layers.dense({ units: 1 }));

// Compiler le modèle
model.compile({ optimizer: 'adam', loss: 'meanSquaredError' });

// Entraîner le modèle
model.fit(xTrain, yTrain, { epochs: 100 })
  .then(info => {
    console.log('Entraînement terminé');
    // Vous pouvez maintenant utiliser le modèle pour faire des prédictions
    const testSequence = data.slice(90, 100); // Séquence de test
    const xTest = tf.tensor([testSequence]);
    const predictions = model.predict(xTest);
    predictions.print();
  });
