
const checker = document.querySelector('#checker').value;
const titre = document.querySelector('#titre-pred');
const vente_stock = document.querySelector('#vente_stock').value * 1;

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
      const sequenceLength = 5;
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
      model.add(tf.layers.lstm({ units: 30, inputShape: [sequenceLength, 1] }));
      model.add(tf.layers.dense({ units: 1 }));

      // Compiler le modèle
      model.compile({ loss: 'meanSquaredError', optimizer: 'adam' });

      // Entraîner le modèle
      
      model.fit(xs, ys, { epochs: 50 }).then(() => {
        // Faire une prédiction
        const inputSequence = salesData.slice(90, 95); // Utiliser les 10 dernières valeurs pour prédire la prochaine
        const inputTensor = tf.tensor3d([inputSequence.map(val => [val])], [1, sequenceLength, 1]);
        const prediction = model.predict(inputTensor);
        const predictedValue = prediction.dataSync()[0];

        
        document.getElementById("resultat-pred").innerHTML = 'Voici la tendance des donnees a ce jours :' + predictedValue;
        document.getElementById("jour").innerHTML = ('Vous avez vendu ce produit 10 fois entre ces 2 dates :'+ input_arr[long - 12] + ' et ' + input_arr[long - 2]+'');
        document.getElementById("predisons").innerHTML = 'Avec cet allure de vente et d apres la prediction, votre stock courant s ecoulera dans :' + Math.round(vente_stock/predictedValue)+' jours';
      });

      /*
      model.fit(xs, ys, { epochs: 50 }).then(() => {
          // Faire une prédiction sur l'ensemble d'entraînement
          const trainPredictions = model.predict(xs);

          const trainMSE = tf.losses.meanSquaredError(ys, tf.squeeze(trainPredictions)).dataSync()[0];
          console.log('Mean Squared Error sur l\'ensemble d\'entraînement :', trainMSE);
          document.getElementById("resultat-pred").innerHTML = ('Mean Squared Error sur l\'ensemble d\'entraînement :', trainMSE);
          // Faire une prédiction sur l'ensemble de test
          const testInputSequence = salesData.slice(80, 85);
          const testInputTensor = tf.tensor3d([testInputSequence.map(val => [val])], [1, sequenceLength, 1]);
          const testPrediction = model.predict(testInputTensor);
          
          // Obtenez toutes les vraies valeurs sur l'ensemble de test
          const trueValues = salesData.slice(86, 91);
          const yt = tf.tensor1d(trueValues);

          // Remplacez le calcul de l'erreur quadratique moyenne comme suit
          const testMSE = tf.losses.meanSquaredError(trueValues[4], tf.squeeze(testPrediction)).dataSync()[0];
          console.log('Mean Squared Error sur l\'ensemble de test :', testMSE);
        


          // Afficher la prédiction de la prochaine vente
          const predictedValues = tf.squeeze(testPrediction).dataSync();
          console.log('Prédictions sur l\'ensemble de test :', predictedValues);
        });*/
      
        
}

}
