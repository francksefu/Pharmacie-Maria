
const checker = document.querySelector('#checker').value;
const titre = document.querySelector('#titre-pred');

if(checker == 'prediction-periode') {
    const input_arr = document.querySelector('#data_in').value.split(',')
    const out_arr = document.querySelector('#data_out').value.split(',')

    if (input_arr.length < 101) {
      titre.innerHTML = "Nous n avons pas pu trouver assez des donnees pour faire une prediction";
    } else {
      
      const salesData = [];
      long = input_arr.length;
      for (let i = long - 2; salesData.length < 101 ; i--) {
        salesData.push(out_arr[i] * 1);
      }

      let date1 = new Date(input_arr[long]);
      let date2 = new Date(input_arr[long - 100]);

      let jour = (date1 - date2) / 60;


      // Préparer les données
      const sequenceLength = 10;
      const dataX = [];
      const dataY = [];

      for (let i = 0; i < salesData.length - sequenceLength; i++) {
        const inputSequence = salesData.slice(i, i + sequenceLength);
        const outputValue = salesData[i + sequenceLength];
        dataX.push(inputSequence);
        dataY.push(outputValue);
      }

      // Convertir les données en tensors
      const xs = tf.tensor3d(dataX.map(seq => seq.map(val => [val])), [dataX.length, sequenceLength, 1]);
      const ys = tf.tensor1d(dataY);

      // Créer un modèle RNN simple
      const model = tf.sequential();
      model.add(tf.layers.lstm({ units: 50, inputShape: [sequenceLength, 1] }));
      model.add(tf.layers.dense({ units: 1 }));

      // Compiler le modèle
      model.compile({ loss: 'meanSquaredError', optimizer: 'adam' });

      // Entraîner le modèle
      model.fit(xs, ys, { epochs: 50 }).then(() => {
        // Faire une prédiction
        const inputSequence = salesData.slice(90, 100); // Utiliser les 10 dernières valeurs pour prédire la prochaine
        const inputTensor = tf.tensor3d([inputSequence.map(val => [val])], [1, sequenceLength, 1]);
        const prediction = model.predict(inputTensor);
        const predictedValue = prediction.dataSync()[0];

        
        document.getElementById("resultat-pred").innerHTML = 'Voici la tendance des donnees a ce jours :' + predictedValue;
        document.getElementById("jour").innerHTML = ('Vous avez vendu ce produit 10 fois entre ces 2 dates :'+ input_arr[long - 12] + ' et ' + input_arr[long - 2]+'');
      });
        
}
// Importer TensorFlow.js
//import * as tf from '@tensorflow/tfjs-node';

// Générer des données de vente synthétiques
  

}
